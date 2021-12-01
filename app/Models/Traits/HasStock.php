<?php

namespace App\Models\Traits;

use Illuminate\Validation\ValidationException;

trait HasStock{

    public function existsProductInStock($product,$qty = 1)
    {

        $product = $this->products()->wherePivot('product_id',$product->id);
        if($product->exists()){
            $product = $product->first();
            if($product->pivot->stock >  $qty || $product->pivot->stock == $qty)
                return $product->pivot->stock;
        }
                
        throw ValidationException::withMessages([
            'stock' => 'Las existencias no son suficientes'
        ]);
        
    }
}

?>