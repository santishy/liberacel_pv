<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\Request;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentPDFController extends Controller
{
    function __invoke(Payment $payment)
    {
        $now = $payment->created_at->format('Y-m-d');
        $payment = PaymentResource::make(
            $payment->load(
                'client',
                'credit'
            )
        );

        $ticketConfig = Ticket::first();
        /** Se crea el frame de pdf la primera vez para calcular que tan grande sera el ticket, mando en altura 2000 como un maximo de altura sin que se rompa el codigo */

        $pdf = PDF::loadView(
            'payments.pdf',
            [
                "now" => $now,
                "payment" => json_encode($payment),
                "ticketConfig" => $ticketConfig
            ]
        )->setPaper(array(0, 0, 227.67, 2000));

        /**
         * Se obtiene la altura, la logica esta guardada en el modelo .. midiendo la altura total del body que esta dentro del padding al menos asi lo entendi
         */
        $height = $ticketConfig->getBodyHeight($pdf->getdomPDF());

        /**
         * Se vuelve a mandar a crear el frame con la altura correspondiente al documento, de forma mas precisa y se manda pintar al final
         */
        $pdf = PDF::loadView(
            'payments.pdf',
            [
                "now" => $now,
                "payment" => json_encode($payment),
                "ticketConfig" => $ticketConfig
            ]
        )->setPaper(array(0, 0, 227.67, $height + 20));
        return $pdf->stream();
    }
}
