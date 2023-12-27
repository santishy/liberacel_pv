<?php

namespace App\Models\Traits;

use App\Models\Commission;
use App\Models\Sale;

trait HasCommission
{

    public function commission()
    {
        return $this->morphOne(Commission::class, 'commissionable');
    }
    public function getTheCommissionAmount()
    {
        $products = ($this instanceof Sale) ?
            $this->products()->get() : $this->products();
        return $this->calculateCommissionAmount($products);
    }
}
