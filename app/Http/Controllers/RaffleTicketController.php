<?php

namespace App\Http\Controllers;

use App\Http\Resources\RaffleNumberResource;
use App\Models\RaffleNumber;
use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RaffleTicketController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RaffleNumber $raffleNumber)
    {
        $this->authorize('view', $raffleNumber);
        $raffleNumber = RaffleNumberResource::make($raffleNumber->load('saleable', 'raffle'))->resolve();
        /** Se crea el frame de pdf la primera vez para calcular que tan grande sera el ticket, mando en altura 2000 como un maximo de altura sin que se rompa el codigo */
        $pdf = PDF::loadView(
            'raffle-numbers.ticket',
            compact('raffleNumber')
        )->setPaper([0, 0, 227.67, 2000]);
        /**
         * Se obtiene la altura, la logica esta guardada en el modelo .. midiendo la altura total del body que esta dentro del padding al menos asi lo entendi
         */
        $height = (new Ticket)->getBodyHeight($pdf->getdomPDF());

        return PDF::loadView(
            'raffle-numbers.ticket',
            compact('raffleNumber')
        )->setPaper([0, 0, 227.67, $height + 40])->stream();
    }
}
