<?php

namespace App\Http\Controllers;

use App\Http\Responses\SessionInactive;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ProductInPurchaseController extends Controller
{
    //corregir parametro en el update
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', new Purchase);

        if (!session()->exists('purchase_id'))
            return new SessionInactive('compra');

        $purchase = Purchase::find(session()->get('purchase_id'));
        if (!$purchase) {
            return response()->json([
                'message' => 'La compra ya no está disponible.',
                'code'    => 'CART_EXPIRED',
            ], 409);
        }
        $data = $request->validate([
            //   'id' => 'required|exists:products,id',
            'purchase_price' => 'required|numeric|min:1',
            'purchase_quantity' => 'required|numeric|min:1',
        ]);

        $max = '999999.99';

        $lineTotal = bcmul((string)$data['purchase_price'], (string) $data['purchase_quantity'], 2);
        if (bccomp($lineTotal, $max, 2) === 1) {
            return response()->json([
                'errors' => ['purchase_price' => ['El precio de compra es demasiado alto y supera el limite establecido.']],
                'code'    => 'LINE_TOTAL_EXCEEDED',
            ], 422);
        }

        try {

            DB::transaction(function () use ($purchase, $product, $request) {
                if (!$purchase->products()->whereKey($product->id)->exists()) {
                    return response()->json([
                        'message' => 'El producto no está en la compra.',
                        'code'    => 'PRODUCT_NOT_IN_PURCHASE',
                    ], 404);
                }
                $purchase->products()->updateExistingPivot($product->id, [
                    'qty' => $request->purchase_quantity,
                    'purchase_price' => $request->purchase_price
                ]);
            });
            return response()->json([
                'totalPurchase' => $purchase->totalPurchase(),
            ], 200);
        } catch (\Exception $e) {
            if (str_contains($e->getCode() ?? '', '22003')) {
                return response()->json([
                    'errors' => ['purchase_price' => ['El precio de compra es demasiado alto.']],

                    //'message' => 'El total de la compra no puede superar los ' . $max . '$.',
                    'code'    => 'TOTAL_PURCHASE_EXCEEDED',
                ], 422);
            }
            report($e);
            return response()->json(
                [
                    'message' => 'Ocurrió un error al actualizar el producto en la compra.',
                    'code'    => 'UPDATE_PRODUCT_IN_PURCHASE_ERROR',
                ],
                500
            );
        }
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
