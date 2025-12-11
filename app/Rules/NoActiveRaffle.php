<?php

namespace App\Rules;

use App\Models\Inventory;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoActiveRaffle implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $inventory = Inventory::find($value);
        if (!$inventory)
            $fail("El inventario seleccionado no existe.");
        $hasActiveRaffle = $inventory->raffles()->where('status', 'active')->exists();
        if ($hasActiveRaffle) {
            $fail("El inventario seleccionado ya tiene una rifa activa.");
        }
    }
}
