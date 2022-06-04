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
            "value" => "required|min:1|numeric",
        ],[
            "name.unique" => "El campo nombre ya existe en la base de datos.",
            "value.required" => "El campo valor es requerido.",
            "value.min" => "El campo valor debe ser como minimo uno.",
            "value.numeric" => "El campo valor debe ser númerico."
        ]);
        $isUpdated = $setting->update($data);
        return response()->json([
            'setting' => $setting,
            'isUpdated' => $isUpdated
        ]);
    }
}
