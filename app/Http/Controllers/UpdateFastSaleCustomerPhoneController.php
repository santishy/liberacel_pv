<?php

namespace App\Http\Controllers;

use App\Enums\RaffleAssignmentResult;
use Illuminate\Http\Request;
use App\Models\FastSale;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateFastSaleCustomerPhoneController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FastSale $sale, Request $request)
    {
        $this->authorize('update',$sale);

        $request->validate([
            'customer_phone' => [Rule::requiredIf($sale->status === "completed"),
                "nullable","string","max:20"],
        ]);

        $sale->validateInventory();
        $sale->validateSaleNotCancelled();
        $sale->validateHasNoRaffleNumber();
        $sale->customer_phone = $request->input('customer_phone');
        $sale->save();
        $raffleNumber = null;
        if($sale->status === 'completed'){
            $raffleNumber = app(\App\Actions\Raffles\AssignRaffleNumberToSaleable::class)->execute($sale);
            if ($raffleNumber instanceof RaffleAssignmentResult) {
                throw ValidationException::withMessages(
                    ['sale' => $raffleNumber->message()]
                );
            }
        }
        return response()->json([
            "customer_phone" => $sale->customer_phone,
            "raffle_number" => $raffleNumber
        ]);
    }
}
