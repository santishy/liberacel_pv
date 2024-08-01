<?php

namespace App\Http\Controllers;

use App\Events\FastSaleUpdated;
use App\Events\SaleTransactionProcessed;
use App\Events\TransactionComplete;
use App\Http\Requests\StoreCheckoutRequest;
use App\Http\Responses\SaleDetailsCheckoutResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CheckoutController extends Controller
{
    private $factors = [
        "completed" => -1,
        "pending" => 1,
    ];
    public function create()
    {
        Gate::authorize("complete sales checkout");
        return view('payment-point.create');
    }
    public function store(StoreCheckoutRequest $request)
    {
        Gate::authorize("complete sales checkout");
        $model = $this->getModel($request->model, $request->id);

        $model->validateUser();

        $model->validateSaleNotCompleted();

        $data = ['status' => "completed"];

        if ($model->isStockSale()) {
            TransactionComplete::dispatch($model, $this->factors["completed"]);
            $data["total"] = $model->calculateTotalSale();
        } elseif ($model->isExpressSale()) {
            //falta agregar bonus, pero hay un request() en el model mal mal
            FastSaleUpdated::dispatch($model);
        }

        $model->update($data);

        if ($model->hasCredit()) {
            $inverse = -1;
            $model->handleCredit($this->factors["completed"] * $inverse);
        }

        SaleTransactionProcessed::dispatch($model);

        $model->load('client');

        return new SaleDetailsCheckoutResponse($model);
    }


    private function getModel($model, $id)
    {
        $model = app("App\Models\\$model")->find($id);
        return $model;
    }
}
