<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FastSale extends Model
{
    use HasFactory;

    protected $casts = [
        'meta' => 'array'
    ];

    protected $fillable = ['status','total','concepts'];

    static function findOrCreateFastSale(){
        if(session()->has('fast-sale')){
            return FastSale::find(session()->get('fast-sale'));
        }
        $fastSale = FastSale::create();
        session()->put('fast-sale', $fastSale);
        return $fastSale;
    }
}
