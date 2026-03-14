<?php

namespace App\Http\Controllers;

use App\Models\FastSale;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;

class FastSalePDFController extends Controller
{
    public function __invoke(FastSale $sale)
    {
        $now = $sale->created_at->format('Y-m-d H:i:s');

        $products = $sale->concepts;
        $user = $sale->user;
        $ticketConfig = Ticket::first();
        $model = 'FastSale';
        $typeOfSale = 'Express';
        $raffleNumber = $sale->raffleNumber;
        $raffle = null;
        if($raffleNumber) {
            $raffle = $raffleNumber->raffle;
        }
        /** Se crea el frame de pdf la primera vez para calcular que tan grande sera el ticket, mando en altura 2000 como un maximo de altura sin que se rompa el codigo */
        $pdf = PDF::loadView(
            'tickets.pdf',
            compact('sale','raffleNumber','raffle', 'typeOfSale', 'now', 'products', 'ticketConfig', 'model', 'user')
        )->setPaper([0, 0, 225, 2000]);

        /**
         * Se obtiene la altura, la logica esta guardada en el modelo .. midiendo la altura total del body que esta dentro del padding al menos asi lo entendi
         */
        $height = $ticketConfig->getBodyHeight($pdf->getdomPDF());

        /**
         * Se vuelve a mandar a crear el frame con la altura correspondiente al documento, de forma mas precisa y se manda pintar al final
         */
        $pdf = PDF::loadView(
            'tickets.pdf',
            compact('sale','raffleNumber','raffle', 'typeOfSale', 'now', 'products', 'ticketConfig', 'model', 'user')
        )->setPaper([0, 0, 225, $height + 20]);

        return $pdf->stream();
    }
}
