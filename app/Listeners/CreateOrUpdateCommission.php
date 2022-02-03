<?php

namespace App\Listeners;

use App\Events\FastSaleUpdated;
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
     * @param  \App\Events\FastSaleUpdated  $event
     * @return void
     */
    public function handle(FastSaleUpdated $event)
    {

        switch ($event->fastSale->status) {
            case 'completed':
                $products  = collect($event->fastSale->concepts);

                $products->map(function ($product) {
                    $this->amount += 5 * $product['qty'];
                });
                //if(!Commission::where('fast_sale_id',$event->fastSale->id)->exists())
                    $commission = Commission::create([
                        'fast_sale_id' => $event->fastSale->id,
                        'amount' => $this->amount
                    ]);
                break;
            case 'cancelled':
                Commission::where('fast_sale_id', $event->fastSale->id)->delete();
                break;
            default:
                return;
        }
    }
}
