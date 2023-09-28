<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->resource->id,
            "created_at" => $this->resource->created_at->format('Y-m-d H:i:s'),
            "amount" => $this->resource->amount,
            "currency_amount" => "$" . number_format($this->resource->amount, 2),
            "client" => ClientResource::make($this->whenLoaded('client')),
            "credit" => CreditResource::make($this->whenLoaded('credit')),
        ];
    }
}
