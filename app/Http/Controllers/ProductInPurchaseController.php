<?php

namespace App\Http\Controllers;

use App\Http\Responses\SessionInactive;
use App\Http\Responses\TransactionResponse;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ProductInPurchaseController extends Controller
{
    //corregir parametro en el update
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', new Purchase);
        request()->validate([
            'id' => 'required|exists:products,id',
            'purchase_price' => 'required|numeric|min:1',
            'purchase_quantity' => 'required|numeric|min:1',
        ]);
        $purchase = Purchase::find(session()->get('purchase_id'));

        $purchase->products()->updateExistingPivot($request->id, [
            'qty' => $request->purchase_quantity,
            'purchase_price' => $request->purchase_price
        ]);
        return response()->json([
            'totalPurchase' => $purchase->totalPurchase(),
        ]);
    }
    public function destroy(Product $product)
    {
        $this->authorize('update', new Purchase); //En realidad es una actualizacion y no un borrado por eso uso "update"
        if (!session()->exists('purchase_id'))
            return new SessionInactive('compra');
        $purchase = Purchase::find(session('purchase_id'));
        $purchase->products()->detach($product->id);
        return response()->json([
            'totalPurchase' => $purchase->totalPurchase(),
        ]);
    }
}
