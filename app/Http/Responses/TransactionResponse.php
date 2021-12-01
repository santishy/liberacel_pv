<?php

namespace App\Http\Responses;

use App\Http\Resources\ProductResource;
use App\Http\Resources\TransactionResource;
use Illuminate\Contracts\Support\Responsable;

class TransactionResponse implements Responsable
{

    public $transaction;

    function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    function toResponse($request)
    {
        return response()->json([
            'transaction' =>  TransactionResource::make( $this->transaction
)        ]) ;
    }
}
