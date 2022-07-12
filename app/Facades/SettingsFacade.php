<?php 

namespace App\Authorization\Facades;

use Illuminate\Support\Facades\Facade;

class SettingsFacade extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'Settings';
    }
}