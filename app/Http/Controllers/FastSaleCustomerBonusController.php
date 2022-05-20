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

        $customer->fastSales()->save($fastSale);
        //$customer->scorePoints();
        return response()->json(['customer' => $customer->fresh()]);
    }
}
