<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function index()
    {
        $productCode = 2000;
        return view('barcode/index', [
            'productCode' => $productCode
        ]);
    }
    
}
