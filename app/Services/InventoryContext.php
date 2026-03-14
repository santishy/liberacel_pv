<?php

namespace App\Services;

class InventoryContext
{
    public function id()
    {
        return session('inventory_id');
    }
}
