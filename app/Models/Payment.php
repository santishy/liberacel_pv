<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['credit_id', 'client_id', 'amount'];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function credit()
    {
        return $this->belongsTo(Credit::class);
    }
}
