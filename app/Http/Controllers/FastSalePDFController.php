<?php

namespace App\Http\Controllers;

use App\Models\FastSale;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FastSalePDFController extends Controller
{
    function __invoke(FastSale $sale)
    {
        $now = $sale->created_at->format('Y-m-d H:i:s');

        $products = $sale->concepts;
        $user = $sale->user;
        $ticketConfig = Ticket::first();
        $model = 'FastSale';
        $typeOfSale = 'Express';

        /** Se crea el frame de pdf la primera vez para calcular que tan grande sera el ticket, mando en altura 2000 como un maximo de altura sin que se rompa el codigo */

        $pdf = PDF::loadView(
            'tickets.pdf',
            compact('sale', 'typeOfSale', 'now', 'products', 'ticketConfig', 'model', 'user')
        )->setPaper(array(0, 0, 225, 2000));

        /**
         * Se obtiene la altura, la logica esta guardada en el modelo .. midiendo la altura total del body que esta dentro del padding al menos asi lo entendi
         */
        $height = $ticketConfig->getBodyHeight($pdf->getdomPDF());

        /**
         * Se vuelve a mandar a crear el frame con la altura correspondiente al documento, de forma mas precisa y se manda pintar al final
         */
        $pdf = PDF::loadView(
            'tickets.pdf',
            compact('sale', 'typeOfSale', 'now', 'products', 'ticketConfig', 'model', 'user')
        )->setPaper(array(0, 0, 225, $height + 20));

        return $pdf->stream();
    }
}
