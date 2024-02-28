<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function create()
    {
        return view('payment-point.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'model' => [Rule::in(['FastSale', 'Sale']), "required"],
            "id" => ["numeric", "required"]
        ]);
        $model = $this->getModel($request->model, $request->id);

        return response()->json([
            "model" => class_basename($model)
        ]);
    }
    public function getModel($model, $id)
    {
        $model = app("App\Models\\$model")->find($id);
        return $model;
    }
}
