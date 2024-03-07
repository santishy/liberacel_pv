<?php

namespace App\Http\Controllers;

use App\Models\FastSale;
use Illuminate\Http\Request;

class ClientFastSaleController extends Controller
{
    public function store(FastSale $fastSale, Request $request)
    {
        $data = $request->validate([
            "phone_number" => "required|exists:clients,phone_number",
        ]);
        $fastSale->client()->associate($data["phone_number"]);
        return response()->json([
            "fast_sale" => $fastSale,
        ]);
    }
}
