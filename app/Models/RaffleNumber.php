<?php

namespace App\Models;

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
}
