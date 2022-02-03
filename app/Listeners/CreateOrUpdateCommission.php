<?php

namespace App\Listeners;

use App\Events\CommissionSale;
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
     * @param  \App\Events\CommissionSale  $event
     * @return void
     */
    public function handle(CommissionSale $event)
    {
        dd('entro al listener');
    }
}
