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
    public function update(Request $request, FastSale $sale)
    {
        $customerBonus = $sale->customerBonus()->first();
        $pointData = Setting::where('name', 'precio_punto')->first();
        $electronicMoney = $customerBonus->getElectronicMoney($pointData);
        $diff = $sale->total - $electronicMoney;
        if ($diff > 0 || $diff == 0) {
            $sale->total = $diff;
            $customerBonus->accumulated_points = 0;
        }else {
            $sale->total = 0;
            $conversionToPoints = $diff / floatval($pointData->value);
            $customerBonus->accumulated_points = $conversionToPoints;
        }
        /* $customerBonus->scorePoints();

        return response()->json(
            ['customerBonus' => $customerBonus->fresh()]
        ); */
    }
}
