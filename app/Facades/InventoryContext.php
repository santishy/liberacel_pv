<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class InventoryContext extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'inventory.context';
    }
}
