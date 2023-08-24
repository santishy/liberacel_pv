<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeStatus
{
    protected $currentStatus = null;
    private $factors = [
        "completed" => -1,
        "pending" => 1,
        "cancelled" => 1
    ];
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

        $this->currentStatus = $event->fastSale->status;

        if (request()->has('status') && !is_null($event->fastSale->user_id))
            if (
                $this->statusSentIsCompleted() ||
                $this->statusSentIsCancelled()
            ) {
                $event->fastSale->status = request()->get('status');
                $event->fastSale->save();
                if ($event->fastSale->is_credit && $event->fastSale->client_id) {
                    $inverse = -1;
                    $event->fastSale->handleCredit($this->factors[$event->fastSale->status] * $inverse);
                }
                session()->forget('fast-sale');
            }
    }
    public function statusSentIsCompleted()
    {
        if (request('status') == 'completed' && $this->currentStatus == 'pending') {
            return true;
        }
        return false;
    }
    public function statusSentIsCancelled()
    {
        if (request('status') == 'cancelled' && $this->currentStatus != 'cancelled') {
            return true;
        }
        return false;
    }
}
