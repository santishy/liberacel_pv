<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FastSale extends Model
{
    use HasFactory;
    protected $fillable = ['status','total','concepts'];

    protected $casts = [
        'concepts' => 'array',
    ];

   public function setConceptsAttribute(){
       dd($this->concepts);
   }
   
    
    static function findOrCreateFastSale(){
        if(session()->has('fast-sale')){
            return FastSale::find(session()->get('fast-sale'));
        }
        $fastSale = FastSale::create();
        session()->put('fast-sale', $fastSale->id);
        return $fastSale;
    }
}
