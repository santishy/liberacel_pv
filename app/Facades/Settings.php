<?php 

namespace App\Facades;

use App\Models\Setting;

class Settings {

    public static function getDataFrom($name)
    {
        return Setting::where('name', $name)->first();
    }
}