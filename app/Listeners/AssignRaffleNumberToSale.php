<?php

namespace App\Listeners;

use App\Enums\RaffleAssignmentResult;
use App\Events\SaleTransactionProcessed;
use Illuminate\Support\Facades\Log;

class AssignRaffleNumberToSale
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(SaleTransactionProcessed $event): void
    {
        $model = $event->model;
        $result = app(\App\Actions\Raffles\AssignRaffleNumberToSaleable::class)->execute($model);
        if($result instanceof RaffleAssignmentResult){
            $details = [
                "reason" => $result->value,
                "saleable_type" => $model->getMorphClass(),
                "saleable_id" => $model->id,
                "inventory_id" => $model->inventory_id
            ];
            Log::{$result->logLevel()}('Venta sin boleto de rifa',$details);
        }
    }
}
