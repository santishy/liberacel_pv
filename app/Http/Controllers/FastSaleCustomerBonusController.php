<?php

namespace App\Http\Controllers;

use App\Facades\Settings;
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
                'electronicMoney' => number_format(
                    $updatedCustomerBonus->getElectronicMoney($pointData),2
                )
            ]
        );
    }
    public function update(Request $request, FastSale $sale)
    {
        $customerBonus = $sale->customerBonus()->first();
        $pointData = Setting::where('name', 'precio_punto')->first();
        //$pointData = Settings::getDataFrom('precio_punto');
        $electronicMoney = $customerBonus->getElectronicMoney($pointData);
        $diff = $sale->total - $electronicMoney;
        if ($diff > 0 || $diff == 0) {
            $sale->total = $diff;
            $sale->electronic_money_discount = $electronicMoney;
            $customerBonus->accumulated_points = 0;
        }else {
            $sale->electronic_money_discount = $sale->total;
            $sale->total = 0;
            $conversionToPoints = $diff / floatval($pointData->value);
            $customerBonus->accumulated_points = $conversionToPoints;
        }
        $sale->save();
        $customerBonus->save();
        /* $customerBonus->scorePoints();

        return response()->json(
            ['customerBonus' => $customerBonus->fresh()]
        ); */
    }
}
