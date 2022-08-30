<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ProductBarcodeController extends Controller
{
    function __invoke(Product $product)
    {
        $pdf = PDF::loadView(
            'barcode/product_barcode.pdf',
            compact('product')
        )->setPaper(array(0, 0, 227.67,20));
        return $pdf->stream();
    }
}
