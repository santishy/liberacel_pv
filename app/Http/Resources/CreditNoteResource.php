<?php

namespace App\Http\Resources;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Whoops\Exception\Formatter;

class CreditNoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "note" => $this->resource->id,
            "createdAt" => $this->resource->created_at->format('Y-m-d H:i:s'),
            "status" => $this->resource->status,
            "total" => "$" . number_format($this->resource->total, 2),
            'typeOfSale' => ($this->resource instanceof Sale) ?
                "Venta Stock" : "Venta Expres",
        ];
    }
}
