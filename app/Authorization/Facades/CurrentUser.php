<?php 

namespace App\Authorization\Facades;

use Illuminate\Support\Facades\Facade;

class CurrentUser extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'CurrentUser';
    }
}