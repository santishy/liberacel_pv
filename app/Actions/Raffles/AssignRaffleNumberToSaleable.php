<?php

namespace App\Actions\Raffles;

use App\Enums\RaffleAssignmentResult;
use App\Models\Raffle;
use App\Models\RaffleNumber;
use Illuminate\Database\UniqueConstraintViolationException;

/**
 * Unica logica de asignacion de boletos de rifa.
 *
 * Llega por dos caminos y los dos terminan aqui:
 *  - automatico: listener AssignRaffleNumberToSale, sobre el evento SaleTransactionProcessed
 *    (CheckoutController, SaleController, UserRelationshipController, FastSaleAssociatedUserController)
 *  - manual: RaffleAssignmentController@store, cuando se captura el telefono de una venta ya hecha
 *
 * El camino automatico tira el valor de retorno; el manual lo convierte en RaffleNumberResource
 * y lo manda a la pantalla del cajero. Por eso lo que se devuelve tiene que ser confiable.
 */
class AssignRaffleNumberToSaleable
{
    public function execute($saleable): RaffleAssignmentResult|RaffleNumber
    {
        $raffle = Raffle::activeForInventory($saleable->inventory_id);
        if ($reason = $this->checkEligibility($saleable, $raffle)) {
            return $reason;
        }
        $raffleNumber = RaffleNumber::getRandomAvailableNumber($raffle->id);
        if (! $raffleNumber) {
            // Se acabaron los numeros: la rifa se cierra sola.
            Raffle::where('id', $raffle->id)->update(['status' => 'finished']);

            return RaffleAssignmentResult::NumbersExhausted;
        }

        try {
            /**
             * updateRaffleNumber devuelve el numero de filas afectadas.
             *
             * Un 0 significa que entre que elegimos el numero y quisimos guardarlo,
             * otra venta se lo llevo (el where del update ya no lo encontro disponible).
             * En ese caso se elige otro y se reintenta, hasta 3 intentos en total.
             */
            $updated = $this->updateRaffleNumber($saleable, $raffleNumber);
            $i = 0;
            while ($i < 2 && $updated === 0) {
                $raffleNumber = RaffleNumber::getRandomAvailableNumber($raffle->id);
                if (! $raffleNumber) {
                    Raffle::where('id', $raffle->id)->update(['status' => 'finished']);

                    return RaffleAssignmentResult::NumbersExhausted;
                }
                $updated = $this->updateRaffleNumber($saleable, $raffleNumber);
                $i++;
            }
            /**
             * Se perdieron los 3 intentos. No es que se hayan acabado los numeros
             * (eso se maneja arriba), es pura concurrencia: no se asigna nada.
             *
             * Sin este return se devolveria $raffleNumber, que en este punto le
             * pertenece a OTRA venta, y el cajero le cantaria al cliente un numero ajeno.
             */
            if ($updated === 0) {
                return RaffleAssignmentResult::ConcurrencyLost;
            }
        } catch (UniqueConstraintViolationException $exception) {
            /**
             * Salta el indice unico de (saleable_type, saleable_id): esta venta ya tenia boleto.
             * Pasa cuando dos peticiones para la MISMA venta corren a la vez y las dos
             * alcanzan a pasar el isParticipating antes de que cualquiera guarde.
             * La venta ya quedo con su boleto, asi que salimos callados.
             */
            return RaffleAssignmentResult::AlreadyHasTicket;
        }
        // Si este fue el ultimo numero disponible, la rifa queda cerrada.
        $raffleNumberAreAvailable = RaffleNumber::where('raffle_id', $raffle->id)->where('status', 'available')->exists();
        if (! $raffleNumberAreAvailable) {
            Raffle::where('id', $raffle->id)->update(['status' => 'finished']);
        }

        /**
         * El update se hizo por consulta, no por el modelo, asi que $raffleNumber todavia
         * trae la foto vieja: refresh() le recarga las columnas.
         *
         * Y RaffleNumberResource arma customer_phone, saleable_type y ticket_number con
         * whenLoaded('saleable'), que NO dispara carga perezosa: si nadie cargo la relacion,
         * esos campos salen vacios. setRelation se la deja cargada sin consultar de nuevo,
         * que es lo que antes hacia associate() por debajo.
         *
         * El orden importa: refresh() vuelve a traer de la base las relaciones ya cargadas,
         * asi que ponerlo al reves costaria una consulta extra.
         */
        return $raffleNumber->refresh()->setRelation('saleable', $saleable);
    }

    /**
     * Marca el numero como asignado, pero solo si sigue disponible.
     *
     * La condicion viaja dentro del SQL a proposito. Preguntarla antes en PHP no sirve:
     * entre la pregunta y la escritura otra venta puede quedarse con el numero.
     * Al mandarla en el where, MySQL desempata solo y devuelve 1 al que gano y 0 al que perdio.
     */
    public function updateRaffleNumber($saleable, $raffleNumber)
    {
        return RaffleNumber::whereKey($raffleNumber->id)
            ->where('status', 'available')
            ->update([
                'status' => 'assigned',
                'saleable_id' => $saleable->id,
                'saleable_type' => $saleable->getMorphClass(),
            ]);
    }

    /**
     * Requisitos para que una venta reciba boleto. Un boleto por venta,
     * sin importar cuantos articulos traiga.
     */
    public function checkEligibility($sale, $raffle)
    {
        if (! $raffle) {
            return RaffleAssignmentResult::NoActiveRaffle;
        }
        if (
            $sale->created_at < $raffle->start_date
            || $sale->created_at > $raffle->end_date
        ) {
            return RaffleAssignmentResult::OutOfDates;
        }
        if (! $sale->customer_phone) {
            return RaffleAssignmentResult::MissingPhone;
        }
        if ($sale->total < $raffle->min_sale_total) {
            return RaffleAssignmentResult::BelowMinimum;
        }
        if ($sale->status != 'completed') {
            return RaffleAssignmentResult::NotCompleted;
        }
        /**
         * Ya tiene boleto: no se le da otro.
         *
         * Este es el guardia que evita los duplicados del uso normal, por ejemplo autorizar
         * dos veces la misma venta express. La relacion raffleNumber() filtra por
         * status = 'assigned', asi que un boleto liberado no cuenta y la venta puede recibir otro.
         */
        if ($sale->raffleNumber()->exists()) {
            return RaffleAssignmentResult::AlreadyHasTicket;
        }

        return null;
    }
}
