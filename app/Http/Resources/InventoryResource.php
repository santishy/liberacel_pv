<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            //'id' => $this->resource->id,
            //'name' => $this->resource->name,
            'products' => ProductResource::collection($this->resource->products),
            //'address' => $this->resource->address
        ];
    }
}
