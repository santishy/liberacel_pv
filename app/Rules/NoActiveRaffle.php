<?php

namespace App\Rules;

use App\Models\Inventory;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoActiveRaffle implements ValidationRule
{
    protected ?int $ignoredId;

    public function __construct(?int $ignoredId = null)
    {
        $this->ignoredId = $ignoredId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $inventory = Inventory::find($value);
        if (! $inventory) {
            $fail('El inventario seleccionado no existe.');
        }
        $query = $inventory->raffles()->where('status', 'active');

        /*
            si existe el id de $raffle quiere decir que es un update
            entonces si el ID enviado, valida que este activa una rifa
            y sea diferente de el id que se mando entonces invalida la accion
            por que ya hay una rifa activa
        */

        $hasActiveRaffle = $query->when(
            $this->ignoredId !== null,
            fn ($q) => $q->whereKeyNot($this->ignoredId)
        )->exists();

        if ($hasActiveRaffle) {
            $fail('El inventario seleccionado ya tiene una rifa activa.');
        }
    }
}
