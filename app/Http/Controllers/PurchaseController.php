<?php

namespace App\Http\Controllers;

use App\Events\TransactionComplete;
use App\Http\Resources\PurchaseResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TransactionResource;
use App\Http\Responses\ReportResponse;
use App\Http\Traits\HasTransaction;
use App\Models\Inventory;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class PurchaseController extends Controller
{
    use HasTransaction;
    public function index()
    {
        $this->authorize('viewAny', new Purchase);
        if (request()->wantsJson()) {
            return new ReportResponse(Purchase::query());
        }
        $inventories = Inventory::all('id', 'name');
        return view(
            'transactions.index',
            [
                'uri' => '/purchases',
                'name' => 'Compras',
                'inventories' => $inventories
            ]
        );
    }
    /*FALTA VALIDAR QUE EL PRODUCTO NO SE REPITA EN LA MISMA COMPRA!!!  PUEDE AGREGARSE OTRO AL DARLE DOBLE CLICK ;) */
    public function store(Request $request)
    {

        $this->authorize('create', new Purchase);
        request()->validate(
            [
                'product_id' => 'exists:products,id'
            ]
        );
        $purchase = Purchase::findOrCreateThePurchase();
        //$productInPurchase = $purchase->getProductInPurchase();

        $purchase->addProduct();
        /*if ($productInPurchase->exists()) {
            $productInPurchase->updateExistingPivot(
                $request->product_id,
                ['qty' => ($productInPurchase->first()->pivot->qty + 1)]
            );
        } else {
            $purchase->products()->attach($request->product_id, [
                'purchase_price' => $request->purchase_price,
                'qty' => 1
            ]);
        }*/
        return response()->json([
            'qty' => $purchase->products()->where('product_id', $request->product_id)->sum('qty'),
            'purchase_id' => $purchase->id,
        ]);
    }

    public function show(Purchase $purchase)
    {
        $this->authorize('view', $purchase);
        $productsInPurchase = ProductResource::collection($purchase->products()->with('category')->get())->resolve();
        $totalPurchase = $purchase->totalPurchase();
        $inventories = Inventory::all();
        return view('purchases.show')
            ->with(compact('productsInPurchase'))
            ->with(compact('totalPurchase'))
            ->with(compact('purchase'))
            ->with(compact('inventories'));
    }
    public function edit(Purchase $purchase)
    {
    }
    public function update(Request $request, Purchase $purchase)
    {
        $this->authorize('update', $purchase); // puede ser el metodo create?
        $request->validate([
            'status' => ['required'],
            'inventory_id' => ['required']
        ]);

        if ($request->status === 'completed')
            $this->deleteSessionVariable('purchase_id');



        $purchase->update($request->all());


        TransactionComplete::dispatch($purchase);

        return new PurchaseResource($purchase);
    }
    public function destroy(Purchase $purchase)
    {
        $this->authorize('delete', $purchase);
        TransactionComplete::dispatch($purchase, request('factor'));
        $purchase->status = 'cancelled';
        $purchase->save();
        $this->deleteSessionVariable('purchase_id');
        return response()->json([
            'status' => $purchase->status
        ]);
    }
}
