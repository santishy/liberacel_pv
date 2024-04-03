<?php

namespace App\Models\Traits;

use App\Models\Sale;

trait SaleModelHandler
{
    public function isStockSale()
    {
        return $this instanceof Sale;
    }
    public function hasCredit()
    {
        return $this->client_id && $this->is_credit;
    }
}
