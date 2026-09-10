<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaffleNumber extends Model
{
    use HasFactory;

    protected $fillable = ['raffle_id', 'number', 'status', 'assigned_to_sale_id'];

    public function raffle()
    {
        return $this->belongsTo(Raffle::class);
    }

    public function saleable()
    {
        return $this->morphTo();
    }

    public static function getRandomAvailableNumber($raffleId)
    {
        return self::where('raffle_id', $raffleId)
            ->where('status', 'available')
            ->inRandomOrder()
            ->first();
    }

    public function scopeByStatus(Builder $query, $value)
    {
        $query->where('status', $value);
    }

    public function scopeForActiveRaffle(Builder $query)
    {
        $query->whereHas('raffle', function (Builder $q) {
            $q->where('status', 'active');
        });
    }

    public function scopeSearch(Builder $query, $value)
    {
        $query->where(function (Builder $q) use ($value) {
            $q->where('number', 'LIKE', "%{$value}%")
                ->orWhere('code', 'LIKE', "%{$value}%")
                ->orWhere('saleable_id', 'LIKE', "%{$value}%")
                ->orWhereHasMorph('saleable', [Sale::class, FastSale::class], function (Builder $q) use ($value) {
                    $q->where('customer_phone', 'LIKE', "%{$value}%");
                });

        });
    }

    public function scopeByRaffle(Builder $query, $raffleId)
    {
        $query->where('raffle_id', $raffleId);
    }
}
