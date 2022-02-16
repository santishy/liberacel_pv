<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommissionResource extends JsonResource
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
            'id' => $this->id,
            'created_at' => optional($this->created_at)->format('Y-m-d H:m:s'),
            'total' => $this->total,
            'products' => json_decode($this->concepts),
            'amount' => $this->amount
        ];
    }
}
