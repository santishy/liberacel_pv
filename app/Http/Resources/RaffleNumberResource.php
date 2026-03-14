<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RaffleNumberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'code' => $this->resource->code,
            'status' => $this->statusTranslation($this->resource->status),
            'created_at' => $this->created_at,
            // 'assigned_at' => $this->when(
            //     $this->resource->status === 'assigned',
            //     optional($this->resource->updated_at)->format('Y-m-d H:i:s'),
            //     '0000-00-00 00:00:00'
            // ),
            'assigned_at' => $this->whenLoaded('saleable', function () {
                 return $this->when(
                    $this->resource->status === 'assigned',
                    optional($this->resource->created_at)->format('Y-m-d H:i:s'),
                    '0000-00-00 00:00:00'
                );
            }),
            'name' => $this->whenLoaded('raffle', function () {
                return $this->raffle->name ?? null;
            }),
            'customer_phone' => $this->whenLoaded('saleable', function () {
                return $this->saleable->customer_phone ?? null;
            }),
            'saleable_type' => $this->whenLoaded('saleable', function () {
                return $this->getTypeOfSale(class_basename($this->saleable_type)) ?? null;
            }),
            'saleable_id' => $this->whenLoaded('saleable', function () {
                return $this->saleable_id ?? null;
            }),
            'ticket_number' => $this->whenLoaded('saleable', function () {
                return $this->saleable->id ?? null;
            }),
            'now' => now()->format('Y-m-d H:i:s'),
        ];
    }

    public function statusTranslation($key)
    {
        return match ($key) {
            'available' => 'DISPONIBLE',
            'assigned' => 'ASIGNADO',
            default => strtoupper($key)
        };
    }
    public function getTypeOfSale($classBasename)
    {
        return match($classBasename) {
            'FastSale' => 'Expres',
            'Sale' => 'Stock',
            default => null,
        };
    }
}
