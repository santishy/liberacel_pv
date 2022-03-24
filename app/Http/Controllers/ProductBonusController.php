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
            $productBonuses = ProductBonus::paginate();
        }
        return view('product-bonus.index');
    }

    public function store(UpdateStoreProductBonus $request)
    {
        return response()
            ->json([
                'productBonus'
                => ProductBonus::create([
                    'name' => $request->name,
                    'points' => $request->points
                ])
            ]);
    }
}
