<?php

namespace App\Models;

use App\Events\FastSaleUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FastSale extends Model
{
    use HasFactory;

    

    protected $fillable = ['status', 'total', 'concepts'];
    protected $appends = ['products'];
    protected $casts = [
        'concepts' => 'array',
    ];

    public function setConceptsAttribute($value)
    {
        if(is_null($this->concepts))
            $this->concepts = [];
        $this->attributes['concepts'] = collect($this->concepts)->prepend($value);
    }

    /**
     * accesor
     */
    public function getProductsAttribute() {
        return $this->concepts;
    }


    static function findOrCreateFastSale()
    {
        if (session()->has('fast-sale')) {
            return FastSale::find(session()->get('fast-sale'));
        }
        $fastSale = FastSale::create();
        session()->put('fast-sale', $fastSale->id);
        return $fastSale;
    }
    public function calculateTotal(){
        $total = 0;
        foreach($this->concepts as $product) {
            $total += $product['price'] * $product['qty'];
        }
        return $total;
    }

    public function scopeDeleteConcept($index){
        if(is_null($index)){
            return null;
        }
        dd($this['concepts']);
        $concepts = array_splice($this['concepts'],$index,1);
        $this['concepts'] = $concepts;
        dd($this['concepts']);
        $this->save();
        return;
    }
}
