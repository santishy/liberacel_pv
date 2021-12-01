<?php

namespace App\Models;

use App\Models\Traits\ReportBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    use HasFactory, ReportBy;
    protected $fillable = ['status', 'total', 'inventory_id', 'user_id'];

    public static function findOrCreateThePurchase()
    {
        if (session()->has('purchase_id')) {
            return Purchase::find(session()->get('purchase_id'));
        }
        $purchase = Purchase::create(['user_id' => Auth::id()]);
        session()->put('purchase_id', $purchase->id);
        return $purchase;
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty', 'purchase_price');
    }
    public function totalPurchase()
    {
        return $this->products()->sum(DB::raw('qty * purchase_price'));
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getProductInPurchase($id = null)
    {
        if (is_null($id)) {
            $id = request('product_id');
        }
        $product = $this->products()->where(['product_id' => $id]);
        return $product;
    }

    public function addProduct($product_id = null, $purchase_price = null)
    {

        if (is_null($product_id)) {
            $product_id = request()->product_id;
        }
        if (is_null($purchase_price)) {
            $purchase_price = request()->purchase_price;
        }
        
        $qty = request()->qty ? request()->qty : 1;
        



        $productInPurchase = $this->getProductInPurchase($product_id);

        if ($productInPurchase->exists()) {
            $productInPurchase->updateExistingPivot(
                $product_id,
                ['qty' => ($productInPurchase->first()->pivot->qty +  $qty)]
            );
        } else {
            $this->products()->attach($product_id, [
                'purchase_price' => $purchase_price,
                'qty' => $qty,
            ]);
        }
    }
}
