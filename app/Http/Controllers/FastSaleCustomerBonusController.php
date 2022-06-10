<?php

namespace App\Http\Controllers;

use App\Models\CustomerBonus;
use App\Models\FastSale;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerBonusRequest;
use App\Models\Setting;

class FastSaleCustomerBonusController extends Controller
{
    public function store(StoreCustomerBonusRequest $customerBonusrequest)
    {

        $customerBonus = CustomerBonus::firstOrCreate(
            $customerBonusrequest->only('phone_number')
        );

        $fastSale = $customerBonus->getFastSale();

        $customerBonus->addFastSale($fastSale);

        $pointData = Setting::where('name', 'precio_punto')->first();

        $updatedCustomerBonus = $customerBonus->fresh();
        
        return response()->json(
            [
                'customer_bonus' => $updatedCustomerBonus,
                'electronicMoney' => $updatedCustomerBonus->getElectronicMoney($pointData) 
            ]
        );
    }
    public function update(Request $request, CustomerBonus $customerBonus)
    {

        $customerBonus->scorePoints();

        return response()->json(
            ['customerBonus' => $customerBonus->fresh()]
        );
    }
}
