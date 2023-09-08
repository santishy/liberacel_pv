<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['credit_id', 'client_id', 'amount', 'status'];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }

    public function handleCredit()
    {

        $credit = $this->credit;

        if ($this->status) {
            $this->DecreaseTotalCreditAndIncreaseAmountPaid($credit);
        } else {
            $this->IncreaseTotalCreditAndDecreaseAmountPaid($credit);
        }

        $credit->save();
        return $credit;
    }
    public function IncreaseTotalCreditAndDecreaseAmountPaid($credit)
    {
        $credit->total_amount += $this->amount;
        $credit->amount_paid  -= $this->amount;
    }
    public function DecreaseTotalCreditAndIncreaseAmountPaid($credit)
    {
        $credit->total_amount -= $this->amount;
        $credit->amount_paid += $this->amount;
    }
}
