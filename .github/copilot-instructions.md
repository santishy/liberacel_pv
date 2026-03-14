# AI Copilot Instructions for Liberacel PV

## Project Overview
This is a Laravel 10 inventory and sales management system for a retail point-of-sale (POS) application. It uses Vue 2 for the frontend, Tailwind CSS for styling, and Laravel Sail for Docker-based development.

**Key Tech Stack:**
- Backend: PHP 8.1+ with Laravel 10, Spatie/Permission for role-based access
- Frontend: Vue 2, Vuex for state management, Vue 2 Datepicker
- Build: Laravel Mix with Webpack, Tailwind CSS with PostCSS
- Database: MySQL 8.0, Eloquent ORM
- PDF Generation: DomPDF, Intervention/Image for image processing

## Architecture & Key Patterns

### Service Container & Dependency Injection
The application uses custom service bindings in `AppServiceProvider`:
- `CurrentUser` - Authorization facade to get authenticated user resource
- `Settings` - Configuration model queries from the database
- `stockValidations` - Gate for stock-related authorization checks
- `inventory.context` - Session-based inventory ID management via `InventoryContext`

**Pattern:** Access via Facades: `Settings::getDataFrom('name')` or direct injection. **Never hardcode configuration—always use the Settings facade.**

### Custom Eloquent Mixins (JsonApiBuilder)
The application extends Eloquent queries with custom methods via `JsonApiBuilder` (booted in `JsonApiProvider`):
- `applyFilters()` - Dynamic filtering via named scopes from query params
- `applyRemovals()` - Dynamic scope removal
- `include()` - Eager loading relationships from query params
- `transactions()` / `getTransaction()` - Sale transaction handling helpers

**Pattern:** Models can call these methods directly on query builders (e.g., `Model::applyFilters()->get()`). Scopes must exist as named scopes on the model.

### Model Traits for Code Reuse
Models use composition via traits to avoid duplication:
- `HasCommission` - Commission calculation logic for `FastSale`, `Sale`, etc.
- `ManagesCredits` - Credit tracking and payment handling
- `ReportBy` - Report generation and filtering
- `SaleModelHandler` - Common sale processing (both `FastSale` and `Sale`)
- `HasUserRelationship` - Belongs-to-user relationships

**Pattern:** Always check for and use existing traits when adding new features to sales-related models.

### Multi-Inventory Context
The application supports multiple inventories (warehouses). The current inventory is stored in the session via `InventoryContext::id()`:
- Middleware `context.inventory` validates and sets active inventory
- Routes using inventory data must have this middleware
- Use `InventoryContext` facade to access the current inventory ID

**Pattern:** When querying sales, products, or stock, always filter by `inventory_id` unless explicitly showing cross-inventory data.

### Role-Based Access Control
Uses `spatie/laravel-permission` for RBAC:
- `RolesPermissionsController` manages roles and permissions
- Models use `Spatie\Permission\Traits\HasRoles` (implicit in User)
- `Policies` directory contains authorization logic per resource
- Gates in `app/Gates/StockValidations.php` for complex business rules

**Pattern:** Always check policies before allowing create/update/delete operations on models.

## Developer Workflows

### Build & Development
```bash
# Start development environment with hot reload
npm run dev              # One-time build
npm run watch          # Watch mode for changes
npm run hot            # Hot module reloading with BrowserSync

# Production build
npm run production

# Laravel Sail (Docker)
sail artisan serve
sail mysql             # Connect to database
```

### Testing
```bash
# Run all tests
php vendor/bin/phpunit

# Run specific suite
php vendor/bin/phpunit --testsuite Unit
php vendor/bin/phpunit --testsuite Feature

# Run specific test file
php vendor/bin/phpunit tests/Unit/SomeTest.php
```

**Test Setup:** Tests inherit from `Tests\TestCase`, which extends `CreatesApplication`. Database is configured in `phpunit.xml` (uses testing database, no in-memory SQLite).

### Database
```bash
# Run migrations
sail artisan migrate

# Create new migration
sail artisan make:migration create_table_name

# Seed database
sail artisan db:seed
```

### Cache & Configuration
The application stores settings in the `settings` table, accessed via `Settings` facade:
```php
$value = Settings::getDataFrom('setting_name');
```

## Code Conventions & Patterns

### Naming Conventions
- **Controllers:** Resource controllers use standard REST operations (`index`, `show`, `create`, `store`, `edit`, `update`, `destroy`)
- **Models:** Singular, Pascal case (e.g., `FastSale`, `ProductBonus`), always define relationships explicitly
- **Migrations:** Follow Laravel conventions: `create_table_name`, `add_column_to_table_name`
- **Routes:** RESTful resource routes preferred; middleware applied per-route or per-group

### Controllers & Request Handling
- Controllers are thin; business logic lives in Models (via methods/traits) and Services
- Route resource binding used for URL parameters (e.g., `Route::resource('products', ProductController::class)`)
- PDF generation via dedicated controllers: `FastSalePDFController`, `PaymentPDFController`
- Authorization via policies injected or checked via gates

### Models & Relationships
All major models explicitly define relationships:
- `FastSale` (quick sales): `client()`, `products()`, `productBonuses()`, commission/credit traits
- `Sale` (standard sales): Similar structure to FastSale
- `Product`: Relates to inventories, categories, barcodes, bonuses
- `Purchase`: Order management with product relationships
- `Payment`, `Credit`, `Commission`: Financial transaction tracking

**Pattern:** Use eager loading with `include()` query param to prevent N+1 queries. Define scopes for common filters.

### Events & Listeners
Key domain events (in `app/Events/`):
- `TransactionComplete` - Triggered after a sale completes
- `SaleTransactionProcessed` - Sale processing step
- `FastSaleUpdated` - FastSale model changes
- `ApplyElectronicMoneyDiscount` - Discount application

**Pattern:** Always dispatch events for domain changes; listeners handle side effects (commissions, notifications, etc.).

### Authorization
- Gates: Custom logic in `StockValidations` (e.g., checking available stock before sale)
- Policies: Per-model authorization in `app/Policies/`
- Check policies in controllers: `$this->authorize('update', $model)`

## Integration Points & External Dependencies

### DomPDF
Generates PDF reports for sales and payments:
```php
use Barryvdh\DomPDF\Facade\Pdf;
$pdf = Pdf::loadView('path.to.view', ['data' => $data])->download('filename.pdf');
```

### Barcode Generation
Uses `milon/barcode` for product barcodes. See `ProductBarcodeController`.

### Image Processing
Uses `intervention/image` for image resizing and transformations. Configured in `config/image.php`.

### Frontend (Vue 2 + Vuex)
- Main app entry: `resources/js/app.js`
- Vuex store for global state management
- Components in Vue; use `vue-infinite-loading` for pagination
- Tailwind CSS with custom plugins (`@tailwindcss/forms`, `tailwind-scrollbar`)
- DatePicker via `vue2-datepicker` for date inputs

## Common Tasks & Patterns

### Adding a New Resource
1. Create model with relationships and scopes
2. Add migration
3. Create resource controller (use `make:controller` with `--resource` flag)
4. Define policy if authorization needed
5. Add routes in `routes/web.php` with appropriate middleware
6. Create Vue component for frontend UI

### Querying with Filters & Includes
The `JsonApiBuilder` allows query params:
```
/api/sales?filter[pending]=1&include=client,products&sort=-created_at
```
The model must define named scopes matching filter names.

### Handling Multi-Inventory
Always consider:
- Does this resource belong to an inventory? Add `inventory_id` column
- Query filters must include `where('inventory_id', InventoryContext::id())`
- Middleware `context.inventory` ensures valid inventory before request processing

### Commission & Credit Calculations
These are complex domain logic—see traits:
- `HasCommission` - Calculates commissions based on sale rules
- `ManagesCredits` - Tracks customer credit usage and payments
Both traits on `FastSale` and `Sale` models; use their methods, don't replicate logic.

## File Structure Reference
- `app/Actions/` - Fortify auth actions + Raffle assignment actions
- `app/Authorization/` - Custom authorization logic and facades
- `app/Http/Controllers/` - 48+ controllers for different resources
- `app/Models/` - 19+ Eloquent models with explicit relationships
- `app/JsonApi/` - Custom query builder extensions
- `resources/views/` - Blade templates for server-rendered pages
- `resources/js/` - Vue components and Vuex store
- `routes/web.php` - All application routes (~280 lines)
- `config/` - App configuration (app, auth, cache, database, etc.)

## Common Gotchas
1. **Inventory context:** Always check middleware `context.inventory` is applied; use `InventoryContext` to get current inventory
2. **Settings:** Config values are in the `settings` table, not `.env`—use the facade
3. **Named scopes:** `applyFilters()` requires models to define scopes matching filter names
4. **Policy authorization:** Check policies exist before modifying resource controllers
5. **Traits over duplication:** Reuse existing traits (HasCommission, ManagesCredits) rather than duplicating logic
6. **Frontend bundle:** Laravel Mix builds to `public/js` and `public/css`; mix-manifest.json tracks hashed assets
