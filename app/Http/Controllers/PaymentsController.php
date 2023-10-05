<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Credit;
use App\Models\Inventory;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PaymentsController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            return PaymentResource::collection(
                Payment::with(['client', 'credit'])->applyFilters()->paginate(25)
            );
        }
        $inventories = Inventory::all('id', 'name');
        return view('payments.index', [
            'inventories' => $inventories
        ]);
    }
    public function store(SavePaymentRequest $request)
    {
        $request->merge(['status' => true]);
        $data = $request->all();

        DB::beginTransaction();

        try {
            $payment = Payment::create($data);
            $updatedCredit = $payment->handleCredit();
            DB::commit();
            return response([
                'payment' => $payment,
                'credit' => $updatedCredit
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            throw ValidationException::withMessages([
                'db' => $e->getMessage()
            ]);
        }
    }
}