<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'sku' => $this->sku,
            'description' => $this->description,
            'wholesale_price' => $this->wholesale_price,
            'retail_price' => $this->retail_price,
            'image_url' => $this->image,
            'distributor_price' => $this->distributor_price,
            'formatted_wholesale_price' =>'$'.number_format($this->wholesale_price,2),
            'formatted_retail_price' => '$'.number_format($this->retail_price,2),
            'formatted_distributor_price' => '$'.number_format($this->distributor_price,2),
            'sale_quantity' => $this->whenPivotLoaded('product_sale',function(){
                return $this->pivot->qty;
            }),
            'sale_price' => $this->whenPivotLoaded('product_sale',function(){
                return $this->pivot->sale_price;
            }),
            'purchase_quantity' => $this->whenPivotLoaded('product_purchase',function(){
                return $this->pivot->qty;
            }),
            'purchase_price' => $this->whenPivotLoaded('product_purchase',function(){
                return $this->pivot->purchase_price;
            }),
            'stock' =>  $this->whenPivotLoaded('inventory_product',function(){
                return $this->pivot->stock;
            }),
            'category_name' =>  $this->category->name,
        ];
    }
}
