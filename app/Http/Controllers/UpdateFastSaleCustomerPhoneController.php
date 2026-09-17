<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\FastSaleResource;
use App\Models\FastSale;

class UpdateFastSaleCustomerPhoneController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FastSale $sale, Request $request)
    {
        $this->authorize('update',$sale);
        $request->validate([
            'customer_phone' => 'nullable|string|max:20',
        ]);

        $sale->customer_phone = $request->input('customer_phone');
        $sale->save();

        return response()->json(["customer_phone" => $sale->customer_phone]);
    }
}
