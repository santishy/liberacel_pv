<?php

use App\Http\Controllers\BarcodeToSellController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientFastSaleController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\CreditNotesController;
use App\Http\Controllers\CreditPaymentsController;
use App\Http\Controllers\CurrentUserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\FastSaleAssociatedUserController;
use App\Http\Controllers\FastSaleController;
use App\Http\Controllers\FastSaleCustomerBonusController;
use App\Http\Controllers\FastSalePDFController;
use App\Http\Controllers\GeneralReportController;
use App\Http\Controllers\ImpersonationController;
use App\Http\Controllers\InventoryContextController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PaymentPDFController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductBarcodeController;
use App\Http\Controllers\ProductBonusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInPurchaseController;
use App\Http\Controllers\ProductInSaleController;
use App\Http\Controllers\ProductsSearchController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RaffleAssignmentController;
use App\Http\Controllers\RaffleNumberController;
use App\Http\Controllers\RaffleNumberCustomerPhoneController;
use App\Http\Controllers\RaffleTicketController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolesPermissionsController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleToClientController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionProductsController;
use App\Http\Controllers\UpdateSaleCustomerPhone;
use App\Http\Controllers\UserCommissionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRelationshipController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehouseCostsController;
use App\Models\FastSale;
use Illuminate\Support\Facades\Route;

// use App\Models\Category;
// use App\Models\Ticket;
// use Illuminate\Support\Facades\Auth;
// use Spatie\Permission\Contracts\Role;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'context.inventory']);

Route::get('home', function () {
    return view('dashboard');
});

// productos

Route::resource('products', ProductController::class)->middleware(['auth', 'context.inventory']);

// productos en venta
Route::get('sale-with-products', [ProductInSaleController::class, 'index'])->middleware(['auth', 'context.inventory']);
Route::post('sales/{product}/products', [ProductInSaleController::class, 'store'])->middleware(['auth', 'context.inventory']);
Route::put('sales/{product}/products', [ProductInSaleController::class, 'update'])->middleware(['auth', 'context.inventory']);
Route::delete('sales/{product}/products', [ProductInSaleController::class, 'destroy'])->middleware(['auth', 'context.inventory']);

// Buscador de productos

Route::get('searching-products', [ProductsSearchController::class, 'index'])->name('searching-produts.index')->middleware(['auth', 'context.inventory']);

// compras

Route::resource('purchases', PurchaseController::class)->middleware(['auth', 'context.inventory']);

// Productos en compra

Route::put('products-in-purchases/{product}', [ProductInPurchaseController::class, 'update'])->middleware(['auth', 'context.inventory']);
Route::delete('products-in-purchases/{product}', [ProductInPurchaseController::class, 'destroy'])->middleware(['auth', 'context.inventory']);

// clientes

Route::resource('clients', ClientController::class)->middleware(['auth', 'context.inventory']);

// sales to client

Route::post('sales-to-clients', [SaleToClientController::class, 'store'])->middleware(['auth', 'context.inventory']);

// categories

Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create')->middleware(['auth', 'context.inventory']);
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store')->middleware(['auth', 'context.inventory']);
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->middleware(['auth', 'context.inventory']);
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index')->middleware(['auth', 'context.inventory']);
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update')->middleware(['auth', 'context.inventory']);
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware(['auth', 'context.inventory']);

// ventas

Route::get('sales', [SaleController::class, 'index'])->middleware(['auth', 'context.inventory']);
Route::get('sales/create', [SaleController::class, 'create'])->name('sales.create')->middleware(['auth', 'context.inventory']);
Route::post('sales/{sale}', [SaleController::class, 'store'])->name('sales.store')->middleware(['auth', 'context.inventory']);
Route::delete('sales/{sale}', [SaleController::class, 'destroy'])->middleware(['auth', 'context.inventory']);
Route::put('sales/{sale}', [SaleController::class, 'update'])->middleware(['auth', 'context.inventory']);
// ROLES

Route::get('roles/create', [RoleController::class, 'create'])->middleware(['auth', 'context.inventory']);
Route::get('roles', [RoleController::class, 'index'])->middleware(['auth', 'context.inventory']);
Route::post('roles', [RoleController::class, 'store'])->middleware(['auth', 'context.inventory']);
Route::get('roles/{role}', [RoleController::class, 'show'])->middleware(['auth', 'context.inventory']);

// ROLES PERMISSIONS
Route::delete('roles/{role}/permissions', [RolesPermissionsController::class, 'destroy'])->middleware(['auth', 'context.inventory']);
Route::post('roles/{role}/permissions', [RolesPermissionsController::class, 'store'])->middleware(['auth', 'context.inventory']);

// users
Route::get('users', [UserController::class, 'index'])->middleware(['auth', 'context.inventory']);
Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware(['auth', 'context.inventory']);
Route::put('users/{user}', [UserController::class, 'update'])->middleware(['auth', 'context.inventory']);
Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware(['auth', 'context.inventory']);
// inventories
Route::resource('inventories', InventoryController::class)->middleware(['auth', 'context.inventory']);
Route::get('warehouses', [WarehouseController::class, 'index'])->middleware(['auth', 'context.inventory']);
Route::delete('warehouses/{inventory}', [WarehouseController::class, 'destroy'])->middleware(['auth', 'context.inventory']);
Route::get('warehouses/{inventory}/edit', [WarehouseController::class, 'edit'])->middleware(['auth', 'context.inventory']);
Route::put('warehouses/{inventory}', [WarehouseController::class, 'update'])->middleware(['auth', 'context.inventory']);

// errors
Route::get('/403', function () {
    return view('errors.403');
});

// impersionations

Route::post('/impersonations', [ImpersonationController::class, 'store'])->middleware(['auth', 'context.inventory']);
Route::delete('/impersonations', [ImpersonationController::class, 'destroy'])->middleware(['auth', 'context.inventory']);

// obtener usuario loggueado

Route::get('/current-user', CurrentUserController::class);

/**
 * tickets
 */
Route::get('pdf-tickets/{sale}', PDFController::class)->middleware(['auth', 'context.inventory']);
Route::put('tickets/{ticket}', [TicketController::class, 'update'])->middleware(['auth', 'context.inventory']);
Route::get('tickets/{ticket}/edit', [TicketController::class, 'edit'])->middleware(['auth', 'context.inventory']);
// ticket venta rapida
Route::get('fast-sale-tickets/{sale}', FastSalePDFController::class)->middleware(['auth', 'context.inventory']);

/**
 * transaction
 */
Route::get('transaction-products', [TransactionProductsController::class, 'index'])->middleware(['auth', 'context.inventory']);

/**
 * Fast sales
 */
Route::post('fast-sales', [FastSaleController::class, 'store'])->middleware(['auth', 'context.inventory']);
Route::get('fast-sales/create', [FastSaleController::class, 'create'])->middleware(['auth', 'context.inventory']);
Route::put('fast-sales/{sale}', [FastSaleController::class, 'update'])->middleware(['auth', 'context.inventory']);
Route::delete('fast-sales/{sale}', [FastSaleController::class, 'destroy'])->middleware(['auth', 'context.inventory']);
Route::get('fast-sales', [FastSaleController::class, 'index'])->middleware(['auth', 'context.inventory']);
/**
 * Relacionar a usuario con cualquier tabla
 */
Route::post('user-relationship', [UserRelationshipController::class, 'store'])->middleware(['auth', 'context.inventory']);
Route::post('fast-sales/{fastSale}/associated-users', [FastSaleAssociatedUserController::class, 'store'])->middleware(['auth', 'context.inventory']);
/**
 * Commissions
 */
Route::get('user-commissions/', [UserCommissionsController::class, 'index'])->middleware(['auth', 'context.inventory']);
Route::put('user-commissions/{commission}', [UserCommissionsController::class, 'update'])->middleware(['auth', 'context.inventory']);

/**
 * Product bonuses
 */
Route::get('product-bonuses', [ProductBonusController::class, 'index'])->middleware(['auth', 'context.inventory']);
Route::post('product-bonuses', [ProductBonusController::class, 'store'])->middleware(['auth', 'context.inventory']);
Route::put('product-bonuses/{productBonus}', [ProductBonusController::class, 'update'])->middleware(['auth', 'context.inventory']);
Route::delete('product-bonuses/{productBonus}', [ProductBonusController::class, 'destroy'])->middleware(['auth', 'context.inventory']);

/**
 * customer bonuses
 */
Route::post('fast-sales-customer-bonuses', [FastSaleCustomerBonusController::class, 'store'])->middleware(['auth', 'context.inventory']);
Route::put('fast-sales/{sale}/customer-bonuses', [FastSaleCustomerBonusController::class, 'update'])->middleware(['auth', 'context.inventory']);
Route::delete('fast-sales/{sale}/customer-bonuses', [FastSaleCustomerBonusController::class, 'destroy'])->middleware(['auth', 'context.inventory']);
/***
 * Settings
 */

Route::get('settings', [SettingController::class, 'index'])->middleware(['auth', 'context.inventory']);
Route::put('settings/{setting}', [SettingController::class, 'update'])->middleware(['auth', 'context.inventory']);

/**
 * Barcode
 */
Route::get('barcode/{product:sku}', [ProductBarcodeController::class, 'show'])->middleware(['auth', 'context.inventory']);

/**
 * Expenses
 */
Route::resource('expenses', ExpenseController::class)->middleware(['auth', 'context.inventory']);

Route::get('expense-report', [ExpenseReportController::class, 'index'])->middleware(['auth', 'context.inventory']);

/**
 * Refunds
 */
Route::get('refunds/create', [RefundController::class, 'create'])->middleware(['auth', 'context.inventory']);
Route::get('refunds/sales', [RefundController::class, 'findSale'])->middleware((['auth', 'context.inventory']));
Route::post('refunds', [RefundController::class, 'store'])->middleware(['auth', 'context.inventory']);

/**
 * Credits
 */
Route::resource('credits', CreditController::class)->middleware(['auth', 'context.inventory']);

/**
 *  Payments
 */
Route::post('payments', [PaymentsController::class, 'store'])->middleware(['auth', 'context.inventory']);
Route::get('payments', [PaymentsController::class, 'index'])->middleware(['auth', 'context.inventory']);
Route::put('payments/{payment}', [PaymentsController::class, 'update'])->middleware(['auth', 'context.inventory']);
Route::delete('payments/{payment}', [PaymentsController::class, 'destroy'])->middleware(['auth', 'context.inventory']);

/**
 * Payment PDF
 */
Route::get('payments-pdf/{payment}', PaymentPDFController::class)->middleware(['auth', 'context.inventory']);

// credit - payments
Route::get('credit/{credit}/payments', [CreditPaymentsController::class, 'show'])->middleware(['auth', 'context.inventory']);

/**
 * Reports
 */
Route::get('general-report', [GeneralReportController::class, 'index'])->middleware(['auth', 'context.inventory']);

/**
 * Costs
 */
Route::get('warehouse-costs/{inventory}', [WarehouseCostsController::class, 'index'])->middleware(['auth', 'context.inventory']);

/**
 * Barcode to sell
 */
Route::post('barcode-to-sell', [BarcodeToSellController::class, 'store'])->middleware(['auth', 'context.inventory']);

/**
 * Checkout
 */
Route::get('checkout', [CheckoutController::class, 'create'])->middleware(['auth', 'context.inventory']);
Route::post('checkout', [CheckoutController::class, 'store'])->middleware(['auth', 'context.inventory']);

/**
 * client-FastSale
 */
Route::post('client/{sale}/fast-sales', [ClientFastSaleController::class, 'store'])->middleware(['auth', 'context.inventory']);

/**
 * credit notes
 */
Route::get('credits/{credit}/notes', [CreditNotesController::class, 'index'])->middleware(['auth', 'context.inventory']);

/**
 * Raffles
 */
Route::view('documentacion/rifas', 'documentation.raffles')->name('documentation.raffles')->middleware(['auth', 'context.inventory']);

Route::resource('raffles', App\Http\Controllers\RaffleController::class)->middleware(['auth', 'context.inventory']);

/**
 * Raffle numbers
 */
Route::middleware(['auth', 'context.inventory'])->group(function () {
    Route::get('raffle-numbers', [RaffleNumberController::class, 'index'])->name('raffle-numbers.index');
    Route::get('raffle-numbers/{raffleNumber}/ticket', RaffleTicketController::class)->name('raffle-numbers.ticket');
    Route::patch('raffle-numbers/{raffleNumber}/customer-phone', [RaffleNumberCustomerPhoneController::class, 'update'])->name('raffle-numbers.customer-phone.update');
    Route::put('raffle-numbers/{raffleNumber}', [RaffleNumberController::class, 'update'])->name('raffle-numbers.update');
});
Route::middleware(['auth', 'context.inventory'])->group(function () {
    Route::get('raffle-assignaments/assign-by-saleable/create', [RaffleAssignmentController::class, 'create'])->name('raffle-assginaments.assign-by-saleable.create');
    Route::post('raffle-assginaments/assign-by-saleable', [RaffleAssignmentController::class, 'store'])->name('raffle-assginaments.store-by-saleable');
});
/**
 * Select inventory
 */
Route::middleware(['auth'])->group(function () {
    Route::get('select-inventory', [InventoryContextController::class, 'show'])->name('select-inventory');
    Route::post('select-inventory', [InventoryContextController::class, 'store'])->name('select.inventory.store');
});

/**
 * Sale customer phone update
 */
Route::patch('sales/{sale}/customer-phone', [UpdateSaleCustomerPhone::class, '__invoke'])->middleware(['auth', 'context.inventory']);
