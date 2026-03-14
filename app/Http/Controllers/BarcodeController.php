<?php

namespace App\Http\Controllers;

class BarcodeController extends Controller
{
    public function index()
    {
        $productCode = 2000;

        return view('barcode/index', [
            'productCode' => $productCode,
        ]);
    }
}
