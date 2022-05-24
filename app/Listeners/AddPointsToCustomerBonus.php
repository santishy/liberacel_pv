<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddPointsToCustomerBonus
{

    public $currentStatus = null;
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->currentStatus = $event->fastSale->getOriginal('status');

        if (request()->has('status') && !is_null($event->fastSale->customer_bonus_id)) {
            if ($this->statusSentIsCompleted()) {
                $customerBonus = $event->fastSale->customerBonus;
                $customerBonus->scorePoints();
            } else {
                dd("send: " . request('status') . " fastSale: {$this->currentStatus}");
            }
        }
    }
    public function statusSentIsCompleted()
    {
        if (request('status') == 'completed' && $this->currentStatus == 'pending') {
            return true;
        }
        return false;
    }
}
