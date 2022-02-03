<?php

namespace App\Models;

use App\Events\FastSaleUpdated;
use App\Models\Traits\ReportBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FastSale extends Model
{
    use HasFactory;
    use ReportBy;

    protected $fillable = ['status', 'total', 'concepts','user_id'];

    protected $casts = [
        'concepts' => 'array',
    ];
    
    protected $dispatchesEvents = [
        'updated' => FastSaleUpdated::class
    ];

    public function setConceptsAttribute($value)
    {
        if (is_null($this->concepts))
            $this->concepts = [];
        $this->attributes['concepts'] = collect($this->concepts)->prepend($value);
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
    public function addConcept(){
        
        $this['concepts'] = request()->only('description','price','qty');
        $this->updateTotal();

    }
    public  function updateTotal(){
        $this->total += request()->price * request()->qty;
        $this->save();
    }
    public function calculateTotal()
    {
        $total = 0;
        foreach ($this->concepts as $product) {
            $total += $product['price'] * $product['qty'];
        }
        return $total;
    }

    public function scopeDeleteConcept(Builder $query, $index)
    {
        if (is_null($index)) {
            return null;
        }

        $products = $this->concepts;
        array_splice($products, $index, 1);
        $this->attributes['concepts'] = collect($products);
        $this->total = $this->calculateTotal();
        $this->save();
        return;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
