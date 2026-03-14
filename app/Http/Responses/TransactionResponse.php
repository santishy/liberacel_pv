<?php

namespace App\Http\Responses;

use App\Http\Resources\TransactionResource;
use Illuminate\Contracts\Support\Responsable;

class TransactionResponse implements Responsable
{
    public $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    public function toResponse($request)
    {
        return response()->json([
            'transaction' => TransactionResource::make($this->transaction
            )]);
    }
}
