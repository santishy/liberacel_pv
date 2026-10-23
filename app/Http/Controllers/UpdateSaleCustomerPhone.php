<?php

namespace App\Http\Controllers;

use App\Enums\RaffleAssignmentResult;
use App\Http\Resources\RaffleNumberResource;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UpdateSaleCustomerPhone extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Sale $sale, Request $request)
    {
        $this->authorize('update',$sale);
        $request->validate([
            'customer_phone' => ["required","string","max:20"],
        ]);

        $sale->validateInventory();
        $sale->validateSaleNotCancelled();
        $sale->validateHasNoRaffleNumber();
        $sale->customer_phone = $request->input('customer_phone');
        $raffleNumber = null;
        DB::transaction(function()use($sale){
            $sale->save();

            if($sale->status === 'completed'){
                $raffleNumber = app(\App\Actions\Raffles\AssignRaffleNumberToSaleable::class)->execute($sale);
                if ($raffleNumber instanceof RaffleAssignmentResult) {
                    throw ValidationException::withMessages(
                        ['sale' => $raffleNumber->message()]
                    );
                }
            }
        });
        return response()->json([
            "customer_phone" => $sale->customer_phone,
            "raffle_number" => $raffleNumber
        ]);
    }
}
