<?php

namespace App\Listeners;

use App\Events\SaleTransactionProcessed;
use App\Models\Commission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateOrUpdateCommission
{
    public $amount = 0;
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

                $products  = collect($model->concepts);

                $products->map(function ($product) {
                    $this->amount += 5 * $product['qty'];
                });
                $model->commission()->create(['amount' => $this->amount]);
                break;
            case 'cancelled':
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
