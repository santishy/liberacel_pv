<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function __invoke(Sale $sale)
    {
        $now = $sale->created_at->format('Y-m-d');

        $products = $sale->products;

        $user = $sale->user;

        $ticketConfig = Ticket::first();

        $model = 'Sale';
        $typeOfSale = 'Stock';
        $raffleNumber = null;
        $raffle = null;
        /** Se crea el frame de pdf la primera vez para calcular que tan grande sera el ticket, mando en altura 2000 como un maximo de altura sin que se rompa el codigo */
        $pdf = PDF::loadView(
            'tickets.pdf',
            compact('sale', 'raffleNumber', 'raffle', 'typeOfSale', 'now', 'products', 'ticketConfig', 'model', 'user')
        )->setPaper([0, 0, 227.67, 2000]);

        /**
         * Se obtiene la altura, la logica esta guardada en el modelo .. midiendo la altura total del body que esta dentro del padding al menos asi lo entendi
         */
        $height = $ticketConfig->getBodyHeight($pdf->getdomPDF());

        /**
         * Se vuelve a mandar a crear el frame con la altura correspondiente al documento, de forma mas precisa y se manda pintar al final
         */
        $pdf = PDF::loadView(
            'tickets.pdf',
            compact('sale', 'raffleNumber', 'raffle', 'typeOfSale', 'now', 'products', 'ticketConfig', 'model', 'user')
        )->setPaper([0, 0, 227.67, $height + 20]);

        if (session()->has('sale_id')) {
            session()->forget('sale_id');
        }

        return $pdf->stream();
    }
}
