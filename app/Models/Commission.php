<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Commission extends Model
{
    use HasFactory;
    protected $fillable = ['amount','fast_sale_id'];

    // public function fast_sales(){
    //     return $this->belongsTo(FastSale::class,'fast_sale_id');
    // }
    
}
