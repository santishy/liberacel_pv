<?php

namespace App\Actions\Raffles;

use App\Models\Raffle;
use App\Models\RaffleNumber;

class AssignRaffleNumberToSaleable
{
    public function execute($saleable)
    {
        $raffle = Raffle::activeForInventory($saleable->inventory_id);
        if (! $this->isParticipating($saleable, $raffle)) {
            return;
        }
        $raffleNumber = RaffleNumber::getRandomAvailableNumber($raffle->id);
        if (! $raffleNumber) {
            Raffle::where('id', $raffle->id)->update(['status' => 'finished']);
            return;
        }
        $raffleNumber->saleable()->associate($saleable);
        $raffleNumber->status = 'assigned';
        $raffleNumber->save();
        $raffleNumberAreAvailable = RaffleNumber::where('raffle_id', $raffle->id)->where('status', 'available')->exists();
        if (! $raffleNumberAreAvailable) {
            Raffle::where('id', $raffle->id)->update(['status' => 'finished']);
        }
       // $raffleNumberAreAvailable = RaffleNumber::availableForRaffle($raffle->id)->exists();
        return $raffleNumber;
    }

    public function isParticipating($sale, $raffle)
    {
        if (
            ! $raffle || $sale->created_at < $raffle->start_date
            || $sale->created_at > $raffle->end_date
        ) {
            return false;
        }
        if (! $sale->customer_phone || $sale->total < $raffle->min_sale_total || $sale->status != 'completed') {
            return false;
        }

        return true;
    }
}
