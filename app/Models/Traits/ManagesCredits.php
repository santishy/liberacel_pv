<?php

namespace App\Models\Traits;

use App\Models\Credit;
use Illuminate\Validation\ValidationException;

trait ManagesCredits{

    public function credits()
    {
        return $this->morphToMany(Credit::class, 'creditable');
    }

    public function handleCredit()
    {
        $credit = Credit::findOrCreate($this->client_id);
        return $this->credits()->attach($credit->id);
    }
}
