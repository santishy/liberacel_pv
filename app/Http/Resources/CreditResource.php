<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreditResource extends JsonResource
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
            'created_at' => $this->resource->created_at->format('Y-m-d H:i:s'),
            'amount_paid' => $this->resource->amount_paid,
            'total_amount' => $this->resource->total_amount,
            'formatted_amount_paid' => "$" . number_format($this->resource->amount_paid, 2),
            'total_amount_formatted' => "$" . number_format($this->resource->total_amount, 2),
            'client' => $this->whenLoaded('client'),
        ];
    }
}
