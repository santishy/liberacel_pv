<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class UpdateSaleCustomerPhone extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Sale $sale,Request $request)
    {
        $request->validate([
            'customer_phone' => 'required|string|max:255',
        ]);

        $sale->customer_phone = $request->input('customer_phone');
        $sale->save();

        return response()->json(['message' => 'Teléfono agregado correctamente.']);
    }
}
