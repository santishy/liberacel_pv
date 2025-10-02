<?php

namespace App\Models\Traits;

use App\Models\FastSale;
use Illuminate\Support\Str;
use App\Models\Sale;
use Illuminate\Validation\ValidationException;

trait SaleModelHandler
{
    public function validateUser()
    {
        if (!$this->user()->exists()) {
            throw ValidationException::withMessages(["user_id" => "No hay usuario asociado a la venta."]);
        }
        return true;
    }
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
        //dd($this->client_id && $this->is_credit);
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
    public function deleteTheSessionID()
    {
        $name = class_basename($this);
        $modelID = Str::snake($name, '_') . '_id';
        if (session()->has($modelID)) {
            session()->forget($modelID);
        }
    }
}
