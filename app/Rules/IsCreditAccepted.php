<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsCreditAccepted implements Rule
{
    private $sale;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($sale = null)
    {
        $this->sale = $sale;
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
        return ($value == 1 || $value == true || $value === 'on')
            &&
            optional($this->sale)->client_id;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Verifique si asigno un cliente a la venta o envío correctamente el campo crédito. ";
    }
}
