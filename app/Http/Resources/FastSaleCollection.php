<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FastSaleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            $this->collection->transform(function ($sale) {
                return [
                    'id' => $sale->id,
                    'total' => number_format($sale->total, 2),
                    'status' => $sale->status,
                    'products' => collect($sale->concepts),
                    'user_id' => optional($sale->user)->id,
                    'user_name' => optional($sale->user)->name,
                    'customer_phone' => $sale->customer_phone,
                    'raffle_number_code' => $sale->relationLoaded('raffleNumber') ?
                         optional($sale->raffleNumber)->code : null,
                    'created_at' => $sale->created_at->format('Y-m-d H:i:s'),
                ];
            });
    }
}
