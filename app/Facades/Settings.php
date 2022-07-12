<?php 

namespace App\Facades;

use App\Models\Setting;

class Settings {

    public function getSettingData($name)
    {
        return Setting::where('name', $name)->first();
    }
}