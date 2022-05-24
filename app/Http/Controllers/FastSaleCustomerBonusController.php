<?php

namespace App\Http\Controllers;

use App\Models\CustomerBonus;
use App\Models\FastSale;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerBonusRequest;

class FastSaleCustomerBonusController extends Controller
{
    public function store(StoreCustomerBonusRequest $customerBonusrequest)
    {

        $customer = CustomerBonus::firstOrCreate(
            $customerBonusrequest->only('phone_number')
        );

        $fastSale = $customer->getFastSale();

        $customer->addFastSale($fastSale);

        //$customer->scorePoints();
        return response()->json(['customer' => $customer->fresh()]);
    }
    public function update(Request $request, CustomerBonus $customerBonus)
    {
        
        $customerBonus->scorePoints();

        return response()->json(
            ['customerBonus' => $customerBonus->fresh()]
        );
    }
}
