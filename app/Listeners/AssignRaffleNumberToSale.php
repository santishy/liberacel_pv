<?php

namespace App\Listeners;

use App\Events\SaleTransactionProcessed;
use App\Models\Raffle;
use App\Models\RaffleNumber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        $raffle =  Raffle::getRaffleByInventory($event->model->inventory_id);

        if (!$this->isParticipating($event->model, $raffle)) return;

        $raffleNumber = RaffleNumber::getRandomAvailableNumber($raffle->id);

        if (!$raffleNumber) {
            Raffle::where('id', $raffle->id)->update(['status' => 'completed']);
            return;
        };
        $raffleNumber->associate($event->model);
        $raffleNumber->status = 'assigned';
        $raffleNumber->save();
    }

    public function isParticipating($sale, $raffle)
    {
        if (!$raffle || $sale->created_at < $raffle->start_date || $sale->created_at > $raffle->end_date)  return false;
        if (!$sale->customer_phone || $sale->total < $raffle->min_sale_total) return false;
        return true;
    }
}
