<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            "client_id" => ["required", "exists:clients,id"],
            "credit_id" => ["required", "exists:credits,id"],
            "amount" => ["required", "min:1", "numeric"]
        ]);

        $payment = Payment::create($data);

        return response(["payment" => $payment->load('client', 'credit')]);
    }
}
