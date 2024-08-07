<?php

namespace App\Models;

use App\Facades\Settings;
use App\Models\Traits\HasCommission;
use App\Models\Traits\HasUserRelationship;
use App\Models\Traits\ManagesCredits;
use App\Models\Traits\ReportBy;
use App\Models\Traits\SaleModelHandler;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FastSale extends Model
{
    use HasFactory, HasUserRelationship;
    use ReportBy, ManagesCredits, HasCommission;
    use SaleModelHandler;

    protected $fillable = [
        'status',
        'total',
        'concepts',
        'user_id',
        'electronic_money_discount',
        'customer_bonus_id',
        'client_id',
        'is_credit'
    ];

    protected $casts = [
        'concepts' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function products()
    {
        return collect($this->concepts);
    }
    public function addBonus()
    {
        $product_bonus_id = request('product_bonus_id');
        $productBonus = $this->productBonuses()
            ->wherePivot('product_bonus_id', $product_bonus_id)
            ->first();

        if (!$productBonus) {
            $this->productBonuses()
                ->attach(
                    $product_bonus_id,
                    ['qty' => request('qty')]
                );
        } else {
            $this->productBonuses()->updateExistingPivot($product_bonus_id, [
                'qty' => $productBonus->pivot->qty + request('qty')
            ]);
        }
    }

    public function productBonuses()
    {
        return $this->belongsToMany(ProductBonus::class)->withPivot('qty');
    }
    public function setConceptsAttribute($value)
    {
        if (is_null($this->concepts))
            $this->concepts = [];
        $this->attributes['concepts'] = collect($this->concepts)->prepend($value);
    }

    public function calculateCommissionAmount($products)
    {

        return $products->sum(function ($product) {
            return $product['commission_amount'] * $product['qty'];
        });
    }


    static function findOrCreateFastSale()
    {
        if (session()->has('fast_sale_id')) {
            return FastSale::find(session()->get('fast_sale_id'));
        }
        $fastSale = FastSale::create();
        session()->put('fast_sale_id', $fastSale->id);
        return $fastSale;
    }
    public function addConcept()
    {
        $this['concepts'] = request()->only('description', 'price', 'qty', 'product_bonus_id', 'commission_amount');
        $this->updateTotal();
    }
    public  function updateTotal()
    {
        $this->total += request()->price * request()->qty;
        $this->save();
    }
    public function calculateTotal()
    {
        $total = 0;

        foreach ($this->concepts as $product) {
            $total += $product['price'] * $product['qty'];
        }

        return $total - $this->electronic_money_discount;
    }

    public function scopeDeleteConcept(Builder $query, $index)
    {
        if (is_null($index)) {
            return null;
        }
        $products = $this->concepts;
        $this->productBonuses()
            ->detach($products[$index]['product_bonus_id']);
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
    public function customerBonus()
    {
        return $this->belongsTo(CustomerBonus::class);
    }

    public function calculateDiscountToTotal($electronicMoney)
    {
        $diff = $this->total - $electronicMoney;
        if ($diff > 0 || $diff == 0) {
            $data = $this->discountElectronicMoney($electronicMoney, $diff);
        } else {
            $data = $this->discountElectronicMoney($this->total, 0);
        }
        return $data;
    }

    public function discountElectronicMoney($discount, $total)
    {
        $this->total = $total;
        $this->electronic_money_discount = $discount;
        return [
            "total" => $total,
            "electronic_money_discount" => $discount
        ];
    }

    public function removeCustomerBonus()
    {
        if ($this->electronic_money_discount > 0) {
            $this->total += $this->electronic_money_discount;
        }
        $customerBonus = $this->customerBonus();
        $customerBonus->dissociate();
        $points  = $customerBonus->first()->conversionToPoints(
            Settings::getDataFrom('precio_punto'),
            $this->electronic_money_discount
        );
        $customerBonus->update(['accumulated_points' => $customerBonus->first()->accumulated_points + $points]);
        $this->electronic_money_discount = 0;
        return $this->save();
    }
}
