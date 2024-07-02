<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = ["client_id", "total_amount", "amount_paid"];

    // public function creditables()
    // {
    //     return $this->hasMany(Creditable::class);
    // }
    static public function findOrCreate($client_id)
    {
        $credit = Credit::where('status', '!=', 'cancelled')
            ->where('status', '!=', 'paid')
            ->where('client_id', $client_id)
            ->orderBy('id', 'desc')
            ->first();

        return $credit ?? Credit::create(['client_id' => $client_id]);
    }
    public function sales()
    {
        return $this->morphedByMany(Sale::class, 'creditable');
    }

    public function fastSales()
    {
        return $this->morphedByMany(FastSale::class, 'creditable');
    }
    public function scopeStatusDifferentFrom($value)
    {
        return $this->where('status', $value);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function scopeWithStatus(Builder $query, $status)
    {
        $query->where('status', $status);
    }
    public function scopeSearchByPhoneNumber(Builder $query, $phoneNumber)
    {
        $query->whereHas('client', function ($clientQuery) use ($phoneNumber) {
            $clientQuery->where('phone_number',  $phoneNumber);
        });
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
