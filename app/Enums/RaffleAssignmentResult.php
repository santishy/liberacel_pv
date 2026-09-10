<?php

namespace App\Enums;

enum RaffleAssignmentResult: string
{
    case NoActiveRaffle = 'no_active_raffle';
    case OutOfDates = 'out_of_dates';
    case MissingPhone = 'missing_phone';
    case BelowMinimum = 'below_minimum';
    case NotCompleted = 'not_completed';
    case AlreadyHasTicket = 'already_has_ticket';
    case NumbersExhausted = 'numbers_exhausted';
    case ConcurrencyLost = 'concurrency_lost';

    public function message(): string
    {
        return match ($this) {
            self::NoActiveRaffle => 'No hay rifas activas.',
            self::OutOfDates => 'La rifa está fuera de la fecha actual.',
            self::MissingPhone => 'La venta no tiene número telefónico.',
            self::BelowMinimum => 'El total de la venta es inferior al mínimo participante para la rifa.',
            self::NotCompleted => 'La venta no está completada.',
            self::AlreadyHasTicket => 'La venta ya tiene un boleto para la rifa.',
            self::NumbersExhausted => 'Boletos agotados para la rifa.',
            self::ConcurrencyLost => 'Problema de concurrencia, vuelva a intentarlo.',
        };
    }

    public function logLevel():string{
        return match ($this){
            self::ConcurrencyLost => 'warning',
            self::NumbersExhausted => 'warning',
            default => 'info'
        };
    }
}
