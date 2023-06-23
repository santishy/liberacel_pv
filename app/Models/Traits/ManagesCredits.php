<?php

namespace App\Models\Traits;

use App\Models\Credit;
use Illuminate\Validation\ValidationException;

trait ManagesCredits
{

    public function credits()
    {
        return $this->morphToMany(Credit::class, 'creditable');
    }

    public function handleCredit($factor)
    {
        $credit = Credit::findOrCreate($this->client_id);
        $credit->update([
            "total_amount" => $credit->total_amount + ($this->total * $factor)
        ]);
        return $this->credits()->attach($credit->id);
    }
}
