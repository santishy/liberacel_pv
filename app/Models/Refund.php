<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','comment','amount','products'];
    protected $casts = [
        'products' => 'array',
    ];
    public function refundable(){
        return $this->morphTo();
    }
}
