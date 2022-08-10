<?php

namespace App\Http\Controllers;

use App\Facades\Settings;
use App\Models\CustomerBonus;
use App\Models\FastSale;
use App\Http\Resources\FastSaleResource;
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
                    $updatedCustomerBonus->getElectronicMoney($pointData),
                    2
                )
            ]
        );
    }
    public function update(Request $request, FastSale $sale)
    {
        $customerBonus = $sale->customerBonus()->first();

        $pointData = Settings::getDataFrom('precio_punto');

        $electronicMoney = $customerBonus->getElectronicMoney($pointData);

        $discountData = $sale->calculateDiscountToTotal($electronicMoney);

        $sale->update($discountData);

        $remainingElectronicMoney = $electronicMoney - $sale->electronic_money_discount;

        $accumulatedPoints = $customerBonus->conversionToPoints(
            $pointData,
            $remainingElectronicMoney
        );

        $customerBonus->update(['accumulated_points' => $accumulatedPoints]);

        return response()->json([
            'fastSale' => FastSaleResource::make($sale->load('customerBonus', 'productBonuses'))
        ]);
    }

    public function destroy(FastSale $fastSale)
    {
        $customerBonusStatus = $fastSale->removeCustomerBonus();
        return response()->json([
            'customerBonusStatus' => $customerBonusStatus
        ]);
    }
}
