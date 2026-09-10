<?php

namespace App\Http\Controllers;

use App\Enums\RaffleAssignmentResult;
use App\Facades\InventoryContext;
use App\Http\Resources\RaffleNumberResource;
use App\Rules\SaleableHasNoRaffleNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class RaffleAssignmentController extends Controller
{
    public function create()
    {
        $this->authorize('assign', new \App\Models\RaffleNumber);

        return view('raffle-assignaments.create');
    }

    public function store(Request $request)
    {
        $this->authorize('assign', new \App\Models\RaffleNumber);
        $request->validate(["saleable_type"=> ["string","required",Rule::in(['FastSale','Sale'])]]);
        $request->validate([
            'customer_phone' => 'required|string',
            'saleable_id' => ['required', 'integer', Rule::exists(
                match ($request->input('saleable_type')) {
                    'FastSale' => 'fast_sales',
                    'Sale' => 'sales',
                }, 'id'
            ), new SaleableHasNoRaffleNumber],

            'saleable_type' => ['required', 'string', Rule::in(['FastSale', 'Sale'])],
        ], [
            'customer_phone.required' => 'El número de teléfono es requerido.',
            'saleable_id.required' => 'El ID de la venta es requerido.',
            'saleable_type.required' => 'El tipo de venta es requerido.',
            'saleable_id.exists' => 'El ID de la venta no existe.'
        ]);

        $saleableClass = $this->mapSaleable($request->input('saleable_type'));

        if (! $saleableClass) {
            throw ValidationException::withMessages(
                ['saleable_type' => 'Tipo de venta invalida.']
            );
        }
        $saleable = $saleableClass::where('inventory_id', InventoryContext::id())
            ->whereKey($request->input('saleable_id'))
            ->first();

        if (! $saleable) {
            throw ValidationException::withMessages(
                ['saleable_id' => 'El ID de la venta no existe en el inventario actual.']
            );
        }

        $saleable->customer_phone = $request->input('customer_phone');
        $saleable->save();
        $raffleNumber = app(\App\Actions\Raffles\AssignRaffleNumberToSaleable::class)->execute($saleable);
        if ($raffleNumber instanceof RaffleAssignmentResult) {
            throw ValidationException::withMessages(
                ['sale' => $raffleNumber->message()]
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
