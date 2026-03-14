<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsSearchController extends Controller
{
    public function index(Request $request)
    {
        return ProductResource::collection(
            Product::with('category')->applyFilters()->where('active', true)->paginate(20)
        );
    }
}
