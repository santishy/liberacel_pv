<?php

namespace App\Models;

use App\Events\FastSaleUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FastSale extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'updated' => FastSaleUpdated::class,
    ];

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
}
