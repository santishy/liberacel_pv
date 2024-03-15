<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\FastSale;
use Illuminate\Http\Request;

class ClientFastSaleController extends Controller
{
    public function store(FastSale $sale, Request $request)
    {
        $data = $request->validate([
            "phone_number" => "required|exists:clients,phone_number",
        ]);

        $client = Client::where("phone_number", $data["phone_number"])->first();

        if (!$client) {
            return response()->json([
                "message" => "Client not found",
            ], 404);
        }

        $sale->client()->associate($client);

        $sale->save();

        return response()->json([
            "sale" => $sale,
        ]);
    }
}
