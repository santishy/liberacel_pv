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

        return $pdf->stream();
    }
    private function generatePDF($data)
    {
        $pdf = PDF::loadView(
            'barcode-to-sell/index',
            compact('data')
        )->setPaper(array(0, 0, 222.67, 62));

        $height = $this->getBodyHeight($pdf->getdomPDF());

        $pdf = PDF::loadView(
            'barcode-to-sell/index',
            compact('data')
        )->setPaper(array(0, 0, 176.4071, $height + 10));

        return $pdf;
    }
}
