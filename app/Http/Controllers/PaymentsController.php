<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePaymentRequest;
use App\Http\Resources\CreditResource;
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
            $payments = Payment::with(['client', 'credit'])->applyFilters();
            $data = [
                "data" => PaymentResource::collection(
                    $payments->paginate(7)
                )
            ];
            if (request('page') == 1) {
                $data['total'] = $payments->sum('amount');
            }
            return response()->json($data);
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
        $credit = Credit::find(request()->credit_id);
        if ($credit->total_amount == 0) {
            return response([], 204);
        }
        DB::beginTransaction();
        try {
            $payment = Payment::create($data);
            $updatedCredit = $payment->handleCredit();
            DB::commit();
            return response([
                'payment' => PaymentResource::make($payment),
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            throw ValidationException::withMessages([
                'db' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            "amount" => ['required', 'min:1', 'numeric']
        ]);
        DB::beginTransaction();
        try {
            $payment->increaseCreditByOldPayment();
            $payment->update($data);
            $updatedCredit = $payment->handleCredit();
            DB::commit();
            return response()->json([
                "payment" => PaymentResource::make($payment),

                //"credit" => CreditResource::make($updatedCredit->load('client')),
            ]);
        } catch (\Exception $e) {
            $this->handleErrorWithRollback($e);
        }
    }
    public function destroy(Payment $payment)
    {
        DB::beginTransaction();
        try {
            $payment->update(["status" => 0]);
            $payment->fresh();
            $updatedCredit = $payment->handleCredit();
            DB::commit();
            return response()->json([
                "payment" => PaymentResource::make($payment),
                //"credit" => CreditResource::make($updatedCredit->load('client')),
            ], 202);
        } catch (\Exception $e) {
            $this->handleErrorWithRollback($e);
        }
    }
    private function handleErrorWithRollback($e)
    {
        DB::rollBack();
        return response()->json([
            "error" => "An error has ocurred",
            "exception" => $e->getMessage()
        ], 500);
    }
}
