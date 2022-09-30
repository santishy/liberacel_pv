<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ProductBarcodeController extends Controller
{
    function show(Product $product)
    {
        $pdf = PDF::loadView(
            'barcode/product_barcode',
            compact('product')
        )->setPaper(array(0, 0, 222.67,62));
        $height = $this->getBodyHeight($pdf->getdomPDF());
        $pdf = PDF::loadView(
            'barcode/product_barcode',
            compact('product')
        )->setPaper(array(0, 0, 176.4071,$height + 10));
        return $pdf->stream();
    }
    public function getBodyHeight($dompdf)
    {
        $GLOBALS['bodyHeight'] = 0;
        $dompdf->setCallbacks(
            array(
                'myCallbacks' => array(
                    'event' => 'end_frame', 'f' => function ($infos) {
                        $frame = $infos["frame"];
                        if (strtolower($frame->get_node()->nodeName) === "body") {
                            $padding_box = $frame->get_padding_box();
                            $GLOBALS['bodyHeight'] += $padding_box['h'];
                        }
                    }
                )
            )
        );
        $dompdf->render();
        unset($dompdf);
        return $GLOBALS['bodyHeight'];
    }
}
