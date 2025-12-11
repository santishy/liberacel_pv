<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RaffleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'formatted_start_date' => $this->resource->start_date->format('d/m/Y H:i'),
            'formatted_end_date' => $this->resource->end_date->format('d/m/Y H:i'),
            'min_sale_total' => $this->resource->min_sale_total,
        ];
    }
}
