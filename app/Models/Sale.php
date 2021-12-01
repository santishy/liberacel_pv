<?php

namespace App\Models;

use App\Models\Traits\ReportBy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory, ReportBy;

    protected $guarded = ['id'];

    public function scopeAdd(Builder $query)
    {
        $query->attach(request()->product_id, [
            'sale_price' => request()->sale_price,
            'qty' => 1
        ]);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function scopeFindOrCreateTheTransaction(Builder $query)
    {
        if (!session()->has('sale_id')) {
            $sale = $query->create(['user_id' => auth()->id()]);
            session()->put('sale_id', $sale->id);
        }
        return $query->find(session()->get('sale_id'));
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('qty', 'sale_price');
    }

    

    public function productInTransaction($product)
    {
        return $this->products()->where('product_id', $product->id);
    }

    //public function scopeUpdateTransactionProduct(Builder $query,$transaction,$product){
    public function scopeUpdateTransactionProduct(Builder $query, $request)
    {
        $query->products()
            ->updateExistingPivot(
                $request->product_id,
                [
                    'qty' => ($request->qty),
                    'sale_price' => $request->sale_price
                ]
            );
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
