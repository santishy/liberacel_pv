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
            return $this->deleteCredit($credit);
        }
        return $this->syncCredit($credit);
    }
    private function isNewCredit($credit)
    {
        if ($credit->fresh()->total_amount != 0.00)
            return false;
        return $credit->status === 'pending';
    }
    private function deleteCredit($credit)
    {
        $this->credits()->detach($credit->id);
        return $credit->delete();
    }

    private function syncCredit($credit)
    {
        return $this->credits()->sync([$credit->id]);
    }
}
