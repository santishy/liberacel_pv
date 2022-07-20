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
            $productBonuses = ProductBonus::orderBy('id', 'desc')->paginate();
            return $productBonuses;
        }
        return view('product-bonus.index');
    }

    public function store(UpdateStoreProductBonus $request)
    {
        return  ProductBonus::create([
            'name' => $request->name,
            'points' => $request->points
        ]);
    }
    public function update(UpdateStoreProductBonus $request, ProductBonus $productBonus)
    {
        $productBonus->update([
            'name' => $request->name,
            'points' => $request->points
        ]);
        return $productBonus;
    }
}
