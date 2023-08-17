<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsCreditAccepted implements Rule
{
    private $client_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($client_id = null)
    {
        $this->client_id = $client_id;
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

        return (($value == 1 || $value == true || $value === 'on')
            &&
            $this->client_id) || $value === false;
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
