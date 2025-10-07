<?php

namespace App\Http\Responses;

use App\Http\Resources\FastSaleCollection;
use App\Http\Resources\TransactionResource;
use Illuminate\Contracts\Support\Responsable;

class ReportResponse implements Responsable
{

    public $model;

    function __construct($model)
    {
        $this->model = $model;
    }

    function toResponse($request)
    {
        $transactions = $this->model->include()->applyFilters();
        //AGREGUE ESTA LINEA PARA OMITIR LAS VENTAS CANCELADAS
        $transactions->where('status', '!=', 'cancelled');
        //  $className = class_basename($this->model);
        if ($this->isFastSale($request->isFastSale)) {
            $data = [
                'data' =>  new FastSaleCollection($transactions
                    ->paginate(25)),
            ];
        } else {
            $data = [
                'data' =>  TransactionResource::collection(
                    $transactions->paginate(25)
                ),
            ];
        }

        if (request('page') == 1) {
            $total = $transactions->sum('total');
            $data["rawTotal"] = $total;
            $data['total'] = number_format($total, 2);
        }

        return response()->json($data);
    }
    private function isFastSale($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
