<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TransactionInventory implements Rule
{
    protected $model;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
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
        if($this->model->inventory_id)
        {
            if($this->model->inventory_id != $value){
                return false;
            }
        }
        return true;
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La transacción actual se realizo en otro almacen, volver a elegir almacén';
    }
}
