<?php

namespace App\Http\Controllers;

use App\Models\CustomerBonus;
use App\Models\FastSale;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerBonusRequest;

class CustomerBonusController extends Controller
{
    public function store(StoreCustomerBonusRequest $customerBonusrequest)
    {
        $customer = CustomerBonus::firstOrCreate(
            $customerBonusrequest->only('phone_number')
        );

        $customer->scorePoints();

        
        return response()->json(['customer' => $customer->fresh()]);
    }
}
