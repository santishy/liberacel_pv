<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use Illuminate\Validation\ValidationException;

class SaleToClientController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('create',new Sale);
        $fields = $request->validate([
            'phone_number' => 'exists:clients,phone_number|required',
        ]);
        
        $this->validateTypeOfSale();

        $sale = Sale::getTransaction();

        $client = $sale->client_id ? $sale->client : Client::where(
            'phone_number',
            $fields['phone_number']
        )->first();

        $sale->client()
            ->associate($client);

        $sale->save();
        
        return response()->json([
            'sale' =>  TransactionResource::make(
                sale::with('client')->where('id',session('sale_id'))->first()
            )
        ]);
    }

    public function validateTypeOfSale()
    {
        if (session()->has('sale_id'))
            if (is_null(Sale::find(session('sale_id'))->client_id))
                throw ValidationException::withMessages([
                    'phone_number' => 'Actualmente hay una venta en proceso'
                ]);
    }
}
