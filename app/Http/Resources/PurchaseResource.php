<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    protected $statuses = [
        'pending' => 'PENDIENTE', 
        'completed' => 'COMPLETADA',
        'cancelled' => 'CANCELADA' 
    ];
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'total' => $this->total,
            'id' => $this->id,
            'status' => $this->statuses[$this->status],
        ];
    }
}
