<?php

namespace App\Http\Resources;

use App\Models\FastSale;
use App\Models\Sale;
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
            'note' => $this->note,
            'created_at' => optional($this->created_at)->format('Y-m-d H:m:s'),
            'total' => $this->total,
            'commissionable' => $this->getResourceCommissionable($this->whenLoaded('commissionable')), //json_decode($this->concepts),
            'type_of_sale' => ($this->whenLoaded('commissionable') instanceof Sale) ? "Venta Stock" : "Venta Expres",
            'amount' => $this->amount
        ];
    }

    public function getResourceCommissionable($relationship)
    {
        return $relationship instanceof FastSale ?
            FastSaleResource::make($relationship) :
            TransactionResource::make($relationship);
    }
}
