<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use app\Models\Purchase;
use app\Models\Sale;

class TransactionProductsController extends Controller
{
    public function index(Request $request)
    {
        
        $request->validate([
            'transactionType' => ['required','regex:/sale|purchase/'],
            'id' => ['required']
        ]);

        $model = str::of(request('transactionType'))->ucfirst();

        $model = app("App\\Models\\{$model}");

        $products = $model->find($request->id)->products()->paginate(25);
        
        return response()->json(['products' => ProductResource::collection($products)]);
    }
}
