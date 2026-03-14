<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\RaffleNumber;

class SaleableHasNoRaffleNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $saleable_id = $value;
        $saleable_type = request()->input('saleable_type');
        
        if (!$saleable_type || !$saleable_id) {
            return;
        }
        $saleable_type = match ($saleable_type) {
            'FastSale' => 'App\Models\FastSale',
            'Sale' => 'App\Models\Sale',
            default => null,
        };
        $raffleNumber = RaffleNumber::query()
            ->where('saleable_id', $saleable_id)
            ->where('saleable_type', $saleable_type)
            ->where('status', 'assigned')
            ->exists() ;

        if ($raffleNumber) {
            $fail('La venta seleccionada ya tiene un número de rifa asignado.');    
        }

    }
}
