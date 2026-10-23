<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignableSaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->resource->id,
            "status" => $this->resource->status,
            "total" => $this->resource->total,
            "name" => $this->whenLoaded("user", function () {
                return $this->user->name;
            }),
            "customer_phone" => $this->resource->customer_phone,
            "created_at" => optional($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
