<?php

namespace App\Http\Controllers;

use App\Http\Resources\RaffleNumberResource;
use App\Models\RaffleNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RaffleNumberCustomerPhoneController extends Controller
{
    public function update(Request $request, RaffleNumber $raffleNumber)
    {
        $this->authorize('update', $raffleNumber);
        $validated = $request->validate([
            'customer_phone' => 'required|string|max:20',
        ]);
        $saleable = $raffleNumber->saleable;
        if ($saleable === null) {
            throw ValidationException::withMessages([
                'raffle_number' => 'Número de rifa debe estar asignado para actualizar el teléfono del cliente.',
            ]);
        }
        $saleable->update(['customer_phone' => $validated['customer_phone']]);

        return RaffleNumberResource::make($raffleNumber);
    }
}
