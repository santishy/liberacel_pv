<?php

namespace App\Http\Controllers;

use App\Events\SaleTransactionProcessed;
use App\Events\TransactionComplete;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    private $factors = [
        "completed" => -1,
        "pending" => 1,
    ];
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
        $data = ['status' => "completed"];
        $model = $this->getModel($request->model, $request->id);

        if ($this->getModelName($model) === "Sale") {
            TransactionComplete::dispatch($model, $this->factors["completed"]);
            $data["total"] = $model->calculateTotalSale();
        }

        $model->update($data);

        if ($this->hasCredit($model)) {
            $inverse = -1;
            $model->handleCredit($this->factors["completed"] * $inverse);
        }

        SaleTransactionProcessed::dispatch($model);

        $model->fresh();
        return response()->json([
            "model" => $model,
            "products" => $model->products,
        ]);
    }
    private function hasCredit($model)
    {
        return $model->client_id && $model->is_credit;
    }
    private function getModelName($model)
    {
        return class_basename($model);
    }
    private function getModel($model, $id)
    {
        $model = app("App\Models\\$model")->find($id);
        return $model;
    }
}
