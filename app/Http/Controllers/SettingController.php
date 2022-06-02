<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{

    public function index()
    {
        $settings = Setting::all();
        return view('settings.index',compact('settings'));
    }

    public function update(Request $request,Setting $setting)
    {
        $data = $request->validate([
            "name" => [Rule::unique('settings')->ignore($setting->id)],
            "value" => "required",
        ]);
        $setting->update($data);
        return response()->json(['setting' => $setting]);
    }
}
