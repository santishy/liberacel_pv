<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class BarcodeToSellController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            "type_of_sale" => ['required', Rule::in(["express", "stock"])],
            "sale_id" => ["required", "numeric"],
        ]);
        $pdf = $this->generatePDF($data);
        // return $pdf->stream();
        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="nombre_del_archivo.pdf"',
        ]);
    }
    private function generatePDF($data)
    {

        $pdf = PDF::loadView(
            'barcode-to-sell/index',
            $data
        )->setPaper(array(0, 0, 222.67, 62));

        $height = $this->getBodyHeight($pdf->getdomPDF());

        $pdf = PDF::loadView(
            'barcode-to-sell/index',
            $data
        )->setPaper(array(0, 0, 176.4071, $height + 10));

        return $pdf;
    }
    public function getBodyHeight($dompdf)
    {
        $GLOBALS['bodyHeight'] = 0;
        $dompdf->setCallbacks(
            array(
                'myCallbacks' => array(
                    'event' => 'end_frame', 'f' => function (\Dompdf\Frame $frame) { //function ($infos) {
                        //$frame = $infos["frame"];
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
