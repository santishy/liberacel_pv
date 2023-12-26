<?php

namespace App\Models;

use App\Models\Traits\ManagesCredits;
use App\Models\Traits\ReportBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Sale extends Model
{
    use HasFactory, ReportBy, ManagesCredits;

    protected $guarded = ['id'];
    protected $client;
    public function refunds()
    {
        return $this->morphMany(Refund::class, 'refundable');
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
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
            $sale = $query->create([
                'user_id' => auth()->id(),
                'inventory_id' => request('inventory_id', null)
            ]);
            session()->put('sale_id', $sale->id);
        }
        return $query->find(session()->get('sale_id'));
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')
            ->withPivot('qty', 'sale_price');
    }

    public function commission()
    {
        return $this->morphOne(Commission::class, "commissionable");
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function refundProduct($product_id, $qty)
    {
        $this->products()->updateExistingPivot($product_id, [
            'qty' => $qty
        ]);
        $isQtyZero = $this->products()
            ->wherePivot('product_id', $product_id)
            ->wherePivot('qty', 0)->exists();

        if ($isQtyZero) {
            $this->products()->detach($product_id);
        }
    }

    public function addClient($phoneNumber = "")
    {
        //hay q usar dissociate por si ya existe y establecer la nueva
        $client = $this->searchForClientPhoneNumber($phoneNumber);
        if ($this->client_id) {
            $this->client()->dissociate($this->client_id);
        }
        $this->client()->associate($client);
        $this->save();
    }

    public function searchForClientPhoneNumber($phoneNumber)
    {
        $client = Client::where(
            'phone_number',
            $phoneNumber
        )->first();
        $this->client = $client;
        return $client;
    }

    public function modifyPricesSales()
    {
        $products = $this->products()
            ->pluck("products.{$this->client->assigned_price}", "products.id")->toArray();
        $sync = [];
        foreach ($products as $productId => $price) {
            $sync[$productId] = ["sale_price" => $price];
        }
        $this->products()->sync($sync);
        return;
    }
}
