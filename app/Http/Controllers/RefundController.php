<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Refund;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RefundController extends Controller
{
    public function findSale(Request $request)
    {
        if (request()->wantsJson()) {
            $sale = Sale::with('client', 'products')->applyFilters();
            if ($sale->count() <= 0) {
                throw ValidationException::withMessages([
                    'id' => 'La Ventas no fue encontrada o el estado no es completado.'
                ]);
            }
            $sale = $sale->first();
            //   session()->put('sale_id', $sale->id);
            return response()->json([
                'sale' => TransactionResource::make($sale)
            ]);
        }
    }
    public function index()
    {
    }
    public function create()
    {
        return view('refunds.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sale_id' => 'required',
            'refund_products' => 'required|array',
            'refund_products.*.qty' => 'numeric|min:0',
            'refund_products.*.product_id' => 'required|exists:products,id',
            'refund_products.*.refund_amount' => 'required|min:1',
            'refund_products.*.sku' => '',
            'total_refund' => 'required|numeric'
        ]);
        $sale = Sale::with(['inventory','products', 'inventory.products'])
            ->find($data['sale_id']);
        $refundAmount = 0;
        foreach ($data['refund_products'] as $item) {
            $sale->refundProduct($item['product_id'], $item['qty']);
            $sale->inventory->products()->updateExistingPivot(
                $item['product_id'],
                ['stock' => DB::raw('stock + ' . $item['refund_amount'])]
            );
        }
        $refund = $sale->refunds()->create([
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
            'amount' =>  $request->total_refund,
            'products' => collect($data['refund_products'])->pluck('sku')
        ]);
        return response()->json([
            'refund' => $refund,
            'skus' => collect($data['refund_products'])->pluck('sku')
        ]);
    }

    public function edit()
    {
    }

    public function update(Request $request, Refund $refund)
    {
    }
}
