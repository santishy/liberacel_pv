<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BarcodeToSellController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            "type_of_sale" => ['required', Rule::in(["express", "stock"])],
            "sale_id" => ["required", "numeric"],
        ]);
    }
}
