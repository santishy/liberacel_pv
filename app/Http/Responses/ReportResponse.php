<?php

namespace App\Http\Responses;

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

        $data = [
            'data' =>  TransactionResource::collection(
                $transactions->paginate(50)
            ),
        ];

        if (request('page') == 1) {
            $data['total'] = number_format($transactions->sum('total'), 2);
        }

        return response()->json($data);
    }
}
