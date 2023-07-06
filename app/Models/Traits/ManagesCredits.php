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
        $isNewCredit = $this->isNewCredit($credit);

        if ($isNewCredit) {
            $this->credits()->detach($credit->id);
            return $credit->delete();
        }
        return $this->credits()->attach($credit->id);
    }
    private function isNewCredit($credit)
    {
        if ($credit->fresh()->total_amount != 0.00)
            return false;
        return $credit->status === 'pending';
    }
}
