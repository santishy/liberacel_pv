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
            "id" => ["number", "required"]
        ]);
        return;
    }
    public function getModel($request)
    {
        $model = str::of($request->model);
        $model = app("App\Models\\$model->ucfirst")->find($request->id);
        return $model;
    }
}
