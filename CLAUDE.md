# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Idioma

El proyecto está en español: mensajes de validación, comentarios, nombres de vistas/rutas en la UI y mensajes de commit. Escribe los mensajes de error de cara al usuario en español y responde al usuario en español.

## Comandos

```bash
# Frontend (Laravel Mix + Vue 2). El build es obligatorio para ver cambios de JS/CSS.
npm run watch          # desarrollo (BrowserSync proxy a localhost:8083, ver webpack.mix.js)
npm run dev            # build único
npm run production     # build de producción

# Backend (Sail/Docker; el .env apunta a DB_HOST=mysql)
sail up -d
sail artisan migrate
sail artisan db:seed --class=RafflePermissionSeeder   # los seeders de permisos se corren individualmente
sail artisan raffles:close-expired                     # también programado cada minuto en Console/Kernel
sail artisan schedule:work

# Tests (PHPUnit 10, contra base de datos real de testing — no SQLite en memoria)
php vendor/bin/phpunit
php vendor/bin/phpunit --testsuite Unit
php vendor/bin/phpunit --filter nombreDelTest tests/Feature/AlgunTest.php

# Formato (preset Laravel, con no_unused_imports deshabilitado — ver .styleci.yml)
./vendor/bin/pint
```

Nota: el proyecto tiene `webpack.mix.js` con dos configuraciones de BrowserSync (Herd comentado, Sail activo). Si se desarrolla con Herd hay que intercambiarlas.

## Arquitectura

Laravel 10 + Vue 2 (sin SPA): las vistas Blade en `resources/views/` son cascarones que montan componentes Vue globales registrados en `resources/js/app.js`. Los componentes piden datos por Axios a las mismas rutas de `routes/web.php` — los controladores devuelven vista o JSON según `$request->wantsJson()`. `routes/api.php` casi no se usa.

### Sucursales / contexto de inventario

Todo el sistema es multi-sucursal (`inventories`). La sucursal activa vive en `session('inventory_id')`:

- El middleware `context.inventory` (`EnsureInventoryContext`) la resuelve: sesión → `user->inventory_id` → única sucursal existente → redirige a `select-inventory`. **Casi toda ruta autenticada lo lleva.**
- Se lee con la facade `InventoryContext::id()` (`App\Facades\InventoryContext` → `App\Services\InventoryContext`).
- Convención: cualquier consulta de ventas, productos, rifas o stock filtra por `inventory_id` salvo que sea un reporte cross-sucursal explícito. Las policies además comparan `$model->inventory_id === InventoryContext::id()` para impedir acceso cruzado.

### Dos tipos de venta

Es la distinción central del dominio. Ambos modelos comparten los traits `SaleModelHandler`, `HasCommission`, `ManagesCredits`, `ReportBy`, `HasUserRelationship`, y ambos se distinguen con `isStockSale()` / `isExpressSale()` / `determineSaleType()`:

| | `Sale` (inventariada / "Stock") | `FastSale` (venta rápida / "Express") |
|---|---|---|
| Productos | pivote `product_sale` con `qty`, `sale_price` | columna JSON `concepts` (descripción + precio + qty a mano) |
| Inventario | descuenta stock vía `TransactionComplete` → `UpdateInventory` | no toca stock |
| Carrito abierto | `session('sale_id')`, `Sale::findOrCreateTheTransaction()` | `session('fast_sale_id')`, `FastSale::findOrCreateFastSale()` |

Ambas se cierran en `CheckoutController@store`, que resuelve el modelo dinámicamente desde `$request->model` (`"Sale"` o `"FastSale"`), valida usuario y estado, despacha los eventos según el tipo, aplica crédito y finalmente despacha `SaleTransactionProcessed`.

### Eventos de venta (registrados en `EventServiceProvider`)

- `TransactionComplete` → `UpdateInventory` — solo ventas inventariadas; el segundo argumento es el factor `-1` (completed) / `+1` (pending) que suma o devuelve stock.
- `SaleTransactionProcessed` → `CreateOrUpdateCommission`, `AssignRaffleNumberToSale` — se dispara para **ambos** tipos de venta, en `CheckoutController`, `SaleController@store`, `UserRelationshipController` y `FastSaleAssociatedUserController`.
- `FastSaleUpdated` → `ChangeStatus`, `AddPointsToCustomerBonus` — solo ventas rápidas.
- `ApplyElectronicMoneyDiscount` → `DecreaseCustomerBonusDiscountPoints` — puntos de cliente ("dinero electrónico").

Los efectos secundarios de una venta van como listener, no inline en el controlador.

### Rifas (feature en desarrollo — rama `liberacel/raffle-wip`)

Una rifa por sucursal a la vez (lo garantiza la regla `NoActiveRaffle`). Al crear una `Raffle` el job `GenerateRaffleNumbers` inserta por chunks los `total_numbers` (default 9999) como `RaffleNumber` con `status = 'available'` y `code` de 4 dígitos.

- Asignación: `App\Actions\Raffles\AssignRaffleNumberToSaleable` es la **única** lógica de asignación. Elige un número disponible al azar, lo asocia por relación polimórfica `saleable` (`Sale` o `FastSale`) y marca `assigned`; si se agotan los números pasa la rifa a `finished`.
- `isParticipating()` exige: rifa activa, venta dentro de `start_date`/`end_date`, `customer_phone` presente, `total >= min_sale_total` y `status = 'completed'`. Un boleto por venta (no por artículo), sin importar cuántos artículos tenga.
- Dos caminos hacia esa acción: automático vía listener `AssignRaffleNumberToSale` en `SaleTransactionProcessed`, y manual vía `RaffleAssignmentController@store` (captura el teléfono de una venta ya hecha y asigna; `SaleableHasNoRaffleNumber` evita duplicar).
- `RaffleNumberController@update` libera un número (`available` + `dissociate()`) bajo la habilidad `release`, distinta de `update`.
- `raffles:close-expired` cierra rifas vencidas; corre cada minuto por el scheduler.
- Los permisos de rifas viven en `RafflePermissionSeeder` (`create/view/edit/delete raffle`, `view/assign/update/release raffle number`), no en `PermissionSeeder`.
- El listener `AssignRaffleNumberToSale` aún conserva la implementación vieja comentada; la fuente de verdad es la Action.

### Filtros y relaciones vía query string (`JsonApiBuilder`)

`JsonApiProvider` hace `Builder::mixin(new JsonApiBuilder)`, agregando a **todo** query builder de Eloquent:

- `applyFilters()` — por cada `filter[x]=v` invoca el scope `scopeX($query, $v)`; aborta 400 si el scope no existe.
- `include()` — `?include=client,products` hace eager loading; aborta 500 si la relación no existe.
- `applyRemovals()`, `transactions()`, `getTransaction()`.

Los índices JSON típicamente devuelven `new ReportResponse(Model::query())`, que encadena `include()->applyFilters()->paginate(25)` y agrega el total sumado en la página 1. Para exponer un filtro nuevo en el frontend basta con **agregar un scope al modelo**; los filtros comunes de fecha/estado ya están en el trait `ReportBy`.

### Autorización

`spatie/laravel-permission` con `Gate::before` que da acceso total al rol `admin` (`AuthServiceProvider`). Las policies de `Raffle`/`RaffleNumber` se resuelven por auto-descubrimiento (no están en el array `$policies`). Los gates de stock se definen en el constructor de `App\Gates\StockValidations`, instanciado desde `AuthServiceProvider::boot()` vía el binding `stockValidations`.

Los controladores usan `$this->authorize(...)` o `Gate::authorize('nombre del permiso')`; los nombres de permiso son frases en inglés con espacios (`'complete sales checkout'`, `'assign raffle number'`).

### Configuración en base de datos

Los valores de negocio (p. ej. `precio_punto`) están en la tabla `settings`, no en `.env`. Se leen con `Settings::getDataFrom('nombre')` (`App\Facades\Settings`). No agregues configuración de negocio a `config/` ni a `.env`.

### PDFs

Tickets y comprobantes con DomPDF. Patrón de dos pasadas: se renderiza primero con altura 2000 para medir con `(new Ticket)->getBodyHeight($pdf->getdomPDF())` y luego se re-renderiza con la altura real (ancho fijo 227.67pt de papel térmico). Ver `RaffleTicketController`, `FastSalePDFController`, `PaymentPDFController`.

## Convenciones

- Controladores de acción única invocables (`RaffleTicketController`, `PDFController`) para operaciones que no encajan en REST.
- La lógica de dominio vive en modelos/traits/actions, no en los controladores; antes de escribir lógica de comisiones, créditos o rifas, revisa `HasCommission`, `ManagesCredits` y `App\Actions\Raffles\`.
- Reglas de validación complejas como clases en `app/Rules/` (`NoActiveRaffle`, `SaleableHasNoRaffleNumber`, `Stock`, `IsCreditAccepted`).
- El estado del frontend está en `resources/js/vuex/` con módulos por dominio (`sales`, `clients`, `inventories`, `raffles`); el menú lateral se define en `resources/js/utilities/menuData.js`.
- `tests/` solo tiene los `ExampleTest` de Laravel: no hay suite real todavía.
