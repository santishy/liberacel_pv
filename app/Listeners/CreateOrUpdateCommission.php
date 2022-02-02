<?php

namespace App\Listeners;

use App\Models\Commission;
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Commission::create([
            'fast_sale_id' => $event->fastSale->id,
            'mounted' => 5 * request('qty')
        ]);
    }
}
