<?php

namespace App\Http\Resources;

use App\Models\Setting;
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
            'id' => $this->id,
            'products' => $this->concepts ? $this->concepts : [],
            'total' =>'$'.number_format($this->total, 2),
            'created_at' => optional($this->created_at)->format('Y-m-d H:m:s'),
            'customer_bonus' => $this->whenLoaded('customerBonus'),
            'product_bonuses' => $this->whenLoaded('productBonuses'),
            'total_unformatted' => $this->total,
            'electronicMoney' => $this->whenLoaded('customerBonus',function(){
                return "$".number_format(
                    ($this->customerBonus->getElectronicMoney(
                    Setting::where('name','precio_punto')->first())
                ),2);
            }),
        ];
    }
}
