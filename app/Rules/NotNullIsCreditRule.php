<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotNullIsCreditRule implements Rule
{
    private $sale;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($sale)
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

        return $value && $this->sale->client_id;
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
