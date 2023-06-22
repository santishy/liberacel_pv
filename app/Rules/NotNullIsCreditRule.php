<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotNullIsCreditRule implements Rule
{
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

        return $attribute && $this->route('sale')->client_id;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Se require el cliente para el crédito.';
    }
}
