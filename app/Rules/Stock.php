<?php

namespace App\Rules;

use App\Models\Inventory;
use Illuminate\Contracts\Validation\Rule;

class Stock implements Rule
{
    public $stock;
    public $product_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return false;
        $Inventory = Inventory::find(request('inventory_id'));

        $product = $Inventory->products()->wherePivot(request('product_id'))->first();

        $this->stock = $product->pivot->stock;

        if($this->stock > $value || $this->stock == $value)
            return true;

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "No hay suficientes existencias [{$this->stock}] .";
    }
}
