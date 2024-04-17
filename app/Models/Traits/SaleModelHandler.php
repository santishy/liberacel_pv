<?php

namespace App\Models\Traits;

use App\Models\FastSale;
use App\Models\Sale;
use Illuminate\Validation\ValidationException;

trait SaleModelHandler
{
    public function isStockSale()
    {
        return $this instanceof Sale;
    }
    public function isExpressSale()
    {
        return $this instanceof FastSale;
    }
    public function hasCredit()
    {
        return $this->client_id && $this->is_credit;
    }
    public function validateSaleNotCompleted()
    {
        if ($this->status === "completed") {
            throw ValidationException::withMessages(["status" => "La venta ya ha sido completada"]);
        }
    }
    public function determineSaleType()
    {
        if ($this->isStockSale()) {
            return 'Stock';
        } elseif ($this->isExpressSale()) {
            return 'Express';
        }
        return null;
    }
}
