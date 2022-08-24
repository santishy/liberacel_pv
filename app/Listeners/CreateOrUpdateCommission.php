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
        $fastSale = $event->fastSale;
        switch ($fastSale->status) {
            case 'completed':
                //comprueba que no sea recursivo
              
                /* if ($fastSale->getOriginal('status') == 'completed') {
                    break;
                } */
                
                $products  = collect($fastSale->concepts);

                $products->map(function ($product) {
                    $this->amount += 5 * $product['qty'];
                });
    
                $commission = Commission::create([
                    'fast_sale_id' => $fastSale->id,
                    'amount' => $this->amount
                ]);
                break;
            case 'cancelled':
                if ($fastSale->getOriginal('status') == 'cancelled') {
                    break;
                }

                Commission::where('fast_sale_id', $fastSale->id)->delete();
                break;
            default:
                return;
        }
    }
}
