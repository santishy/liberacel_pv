# Listar productos inactivos
avisar al cliente cuando quiera ingresar un sku o algún producto que ya exista pero que no lo pueda ver por que esta inactivo.

# Autorización de venta rápida (Express)

Contexto: para destrabar el 403 al guardar el teléfono de rifa, se otorgó a las vendedoras
el permiso **"Editar venta rápida"** (`edit fast sale`). Ese permiso también habilita editar
conceptos (precio, cantidad, descripción) y marcar la venta como crédito.

- [ ] **El teléfono de rifa no debería requerir `edit fast sale`.**
  `UpdateFastSaleCustomerPhoneController` hace `authorize('update', $sale)` → `FastSalePolicy::update`.
  Cambiarlo para que pida `create fast sale` (el permiso con el que ya arman la nota) y, una vez
  hecho, evaluar si se les retira "Editar venta rápida".
- [ ] **El endpoint del teléfono no valida estado ni sucursal.**
  Rechazar notas que no estén `pending` y notas cuyo `inventory_id` no sea `InventoryContext::id()`.
  Hoy se puede cambiar el teléfono de una venta ya completada (no mueve el boleto, pero deja el dato inconsistente).
- [ ] **`FastSaleController@update` no valida estado, sucursal ni la venta real.**
  Autoriza contra `new FastSale` en lugar de `$sale`, y ni el controlador ni `UpdateFastSaleRequest`
  revisan `status` ni `inventory_id`. Con `edit fast sale`, una petición armada a mano puede cambiar
  precio/cantidad de cualquier nota, incluidas completadas y de otra sucursal, después de calculadas
  comisión y crédito. Desde la UI no se alcanza (el doble clic solo existe sobre la nota abierta),
  pero el hueco es real en el código actual.
