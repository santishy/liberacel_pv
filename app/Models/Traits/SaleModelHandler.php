<?php

namespace App\Models\Traits;

use App\Facades\InventoryContext;
use App\Models\FastSale;
use App\Models\Sale;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

trait SaleModelHandler
{
    public function validateUser()
    {
        if (! $this->user()->exists()) {
            throw ValidationException::withMessages(['user_id' => 'No hay usuario asociado a la venta.']);
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
        // dd($this->client_id && $this->is_credit);
        return $this->client_id && $this->is_credit;
    }

    public function validateSaleNotCompleted()
    {
        if ($this->status === 'completed') {
            throw ValidationException::withMessages(['status' => 'La venta ya ha sido completada']);
        }
    }
    public function validateSaleNotCancelled()
    {
        if ($this->status === 'cancelled') {
            throw ValidationException::withMessages(['status' => 'La venta está cancelada']);
        }
    }
    public function validateHasNoRaffleNumber(){
        if($this->raffleNumber()->exists()){
            throw ValidationException::withMessages(['status' =>"La nota #{$this->id} ya tiene un número de rifa asignado, cambialo en el menu Rifas -> Boletos de rifa " ]);
        }
    }
    public function validateInventory(){
        if($this->inventory_id !== (int)InventoryContext::id()){
            throw ValidationException::withMessages(['inventory_id' => 'La venta se realizó en otra sucursal.  ']);
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
        $modelID = Str::snake($name, '_').'_id';
        if (session()->has($modelID)) {
            session()->forget($modelID);
        }
    }
}
