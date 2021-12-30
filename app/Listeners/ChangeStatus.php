<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeStatus
{
    protected $currentStatus = null;
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
            if ($this->statusSentIsCompleted() || $this->statusSentIsCancelled()) {
                $event->fastSale->status = request()->get('status');
                $event->fastSale->save();
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
