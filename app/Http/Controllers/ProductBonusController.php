<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStoreProductBonus;
use App\Models\ProductBonus;
use Illuminate\Http\Request;

class ProductBonusController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            $productBonuses = ProductBonus::where('status', true)->orderBy('id', 'desc')->paginate();
            return $productBonuses;
        }
        return view('product-bonus.index');
    }

    public function store(UpdateStoreProductBonus $request)
    {
        return  ProductBonus::create([
            'name' => $request->name,
            'points' => $request->points,
            'commission_amount' => $this->getCommissionAmount()
        ]);
    }
    private function getCommissionAmount()
    {
        return request()->has('commission_amount') ? request()->commission_amount : 5;
    }
    public function update(UpdateStoreProductBonus $request, ProductBonus $productBonus)
    {
        $productBonus->update([
            'name' => $request->name,
            'points' => $request->points,
            'commission_amount' => $this->getCommissionAmount()
        ]);
        return $productBonus;
    }
    public function destroy(ProductBonus $productBonus)
    {
        $removedProductBonus = $productBonus->update(['status' => false]);
        return response()->json([
            'removedProductBonus' => $removedProductBonus
        ]);
    }
}
