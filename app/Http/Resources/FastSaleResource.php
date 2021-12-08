<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FastSaleResource extends JsonResource
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
            'status' => $this->status,
            'products' => $this->concepts,
            'total' =>'$'.number_format($this->total, 2),
            'created_at' => $this->created_at,
        ];
    }
}
