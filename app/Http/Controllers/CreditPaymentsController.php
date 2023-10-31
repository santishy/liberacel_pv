<?php

namespace App\Http\Controllers;

use App\Http\Resources\CreditResource;
use App\Http\Resources\PaymentResource;
use App\Models\Credit;
use Illuminate\Http\Request;

class CreditPaymentsController extends Controller
{
    /**
     * PENDIENTE, ver si es mejor opcion crear un CreditPaymentsResource o un response para esto
     */
    public function show(Credit $credit)
    {
        return response()->json([
            "credit" => CreditResource::make($credit),
            "payments" => PaymentResource::collection(
                $credit->payments()->where('status', true)->orderBy('id', 'desc')->paginate(5)
            )
        ]);
    }
}
