<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PaymentsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            "client_id" => ["required", "exists:clients,id"],
            "credit_id" => ["required", "exists:credits,id"],
            "amount" => ["required", "min:1", "numeric"]
        ]);
        DB::beginTransaction();
        try {
            $data['status'] = true;
            $payment = Payment::create($data);
            $updatedCredit = $payment->handleCredit();
            DB::commit();
            return $updatedCredit;
        } catch (\Exception $e) {
            DB::rollback();
            throw ValidationException::withMessages([
                'db' => $e->getMessage()
            ]);
        }
    }
}
