<?php

namespace App\Listeners;

use App\Events\TransactionComplete;
use App\Models\Inventory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UpdateInventory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TransactionComplete  $event
     * @return void
     */
    public function handle(TransactionComplete $event)
    {
        $inventory = Inventory::find(request('inventory_id'));
        $factor = $event->factor; // para sumar o restar segun se tenga que actualizar
        DB::beginTransaction();
        $event->transaction->products()->get()->map(
            function ($product) use ($inventory, $factor) {

                $productInTransaction = $inventory->products()->wherePivot('product_id', $product->id);
                if ($productInTransaction->exists()) {

                    $stock = $productInTransaction->first()->pivot->stock + ($factor * $product->pivot->qty);
                    if ($stock < 0) {
                        DB::rollBack();
                        throw ValidationException::withMessages([
                            'stock' => "Las existencias del producto: {$product->sku}, no son suficientes para realizar esta operación"
                        ]);
                    }
                    $inventory->products()->updateExistingPivot(
                        $productInTransaction->first()->id,
                        ['stock' => $stock]
                    );
                } else {
                    $inventory->products()->attach($product->id, ['stock' => $product->pivot->qty]);
                }
            }
        
        );
        DB::commit();
    }
}
