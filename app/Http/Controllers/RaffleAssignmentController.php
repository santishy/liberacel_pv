<?php

namespace App\Http\Controllers;

use App\Http\Resources\RaffleNumberResource;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Rules\SaleableHasNoRaffleNumber;
class RaffleAssignmentController extends Controller
{
    public function create()
    {
        return view('raffle-assignaments.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'customer_phone' => 'required|string',
            'saleable_id' => ['required','integer',Rule::exists(
                match($request->input('saleable_type')) {
                    'FastSale' => 'fast_sales',
                    'Sale' => 'sales',
                },'id'
            ),new SaleableHasNoRaffleNumber()],
            
            'saleable_type' => ['required','string',Rule::in(['FastSale','Sale'])],
        ],[
            'customer_phone.required' => 'El número de teléfono es requerido.',
            'saleable_id.required' => 'El ID de la venta es requerido.',
            'saleable_type.required' => 'El tipo de venta es requerido.',
            'saleable_id.exists' => 'El ID de la venta no existe.',
            ''
        ]);
        
        $saleableClass = $this->mapSaleable($request->input('saleable_type'));
        
        if (!$saleableClass) {
            throw \Illuminate\validation\ValidationException::withMessages(
                ['saleable_type' => 'Tipo de venta invalida.']
            );
        }
        $saleable = $saleableClass::findOrFail($request->input('saleable_id'));
        $saleable->customer_phone = $request->input('customer_phone');
        $saleable->save();
        $raffleNumber = app(\App\Actions\Raffles\AssignRaffleNumberToSaleable::class)->execute($saleable);
        if (!$raffleNumber) {
             throw \Illuminate\validation\ValidationException::withMessages(
                ['sale' => 'Tipo de venta invalida.']
            );
        }
        return RaffleNumberResource::make($raffleNumber);

    }

    public function mapSaleable($key)
    {
        return match ($key) {
            'FastSale' => \App\Models\FastSale::class,
            'Sale' => \App\Models\Sale::class,
            default => null,
        };
    }
}
