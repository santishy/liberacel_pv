<?php

namespace App\Listeners;

use App\Events\SaleTransactionProcessed;
use App\Http\Resources\ProductResource;
use App\Models\FastSale;
use App\Models\Sale;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateOrUpdateCommission
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
    public function getAmount($model)
    {
        $amount = 0;
        $products  = $model->products();

        if ($model instanceof FastSale) {
            $products->map(function ($product) use ($amount) {
                $amount += 5 * $product['qty'];
            });
        }

        if ($model instanceof Sale) {
            $products->get()->map(function ($product) use ($amount) {
                $amount += $product->pivot->qty * 5;
            });
        }
        return $amount;
    }
    /**
     * Handle the event.
     *
     * @param  \App\Events\SaleTransactionProcessed  $event
     * @return void
     */
    public function handle(SaleTransactionProcessed $event)
    {
        $model = $event->model;
        switch ($model->status) {
            case 'completed':
                //comprueba que no sea recursivo

                /* if ($model->getOriginal('status') == 'completed') {
                    break;
                } */

                $model->commission()->create([
                    'amount' => $this->getAmount($model),
                    'user_id' => $model->user_id,
                ]);
                break;
            case 'cancelled':
            case 'pending':
                // if ($model->getOriginal('status') == 'cancelled') {
                //     break;
                // }
                $commission = $model->commission();
                if ($commission->exists()) {
                    $model->commission()->delete();
                }

                //Commission::where('fast_sale_id', $model->id)->delete();
                break;
            default:
                return;
        }
    }
}
