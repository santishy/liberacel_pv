<?php

namespace App\Listeners;

use App\Events\SaleTransactionProcessed;
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
                //comprueba que no sea recursivo esto cuando se agrega el dispatch directamente en el modelo
                /* if ($model->getOriginal('status') == 'completed') {
                    break;
                } */

                $model->commission()->create([
                    'amount' => $model->getTheCommissionAmount(),
                    'user_id' => $model->user_id,
                ]);

                break;
            case 'cancelled':
            case 'pending':
                $commission = $model->commission();
                if ($commission->exists()) {
                    $model->commission()->delete();
                }
                break;
            default:
                return;
        }
    }
}
