<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\Traits\ReportBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory, ReportBy;
    protected $fillable = ['credit_id', 'client_id', 'amount', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }
    /**
     * Nota, en DecreaseTotalCreditAndIncreaseAmountPaid podria ser que el abono supera el adeudo ...
     * quedaria pendiente avisarle al usuario que hay que regresar el cambio $
     */
    public function handleCredit()
    {

        $credit = $this->credit;

        if ($this->status) {
            $this->DecreaseTotalCreditAndIncreaseAmountPaid($credit);
        } else {
            $this->IncreaseTotalCreditAndDecreaseAmountPaid($credit);
        }
        if ($this->checkIfBalanceIsZero($credit)) {
            $credit->status = "paid";
        }

        $credit->save();

        return $credit;
    }
    function increaseCreditByOldPayment()
    {
        $credit = $this->credit;
        $this->IncreaseTotalCreditAndDecreaseAmountPaid($credit);
    }
    protected function checkIfBalanceIsZero($credit)
    {
        return $credit->total_amount === 0;
    }
    public function IncreaseTotalCreditAndDecreaseAmountPaid($credit)
    {
        if (Str::upper($credit->status) === "PAID") {
            $credit->status = "pending";
        }
        $credit->total_amount += $this->amount;
        $credit->amount_paid  -= $this->amount;
    }
    public function DecreaseTotalCreditAndIncreaseAmountPaid($credit)
    {
        $newTotal = $credit->total_amount - $this->amount;
        if ($newTotal < 0) {
            $this->amount = $credit->total_amount;
            $credit->total_amount = 0;
        } else {
            $credit->total_amount -= $this->amount;
        }
        $credit->amount_paid += $this->amount;
    }
}
