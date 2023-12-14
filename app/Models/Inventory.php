<?php

namespace App\Models;

use App\Models\Traits\HasStock;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Inventory extends Model
{
    use HasFactory, HasStock;

    protected $fillable = ['name', 'address'];

    public function products()
    {
        //en la coudmentaicon decia ->withPivot('campo_1','campo_2');
        return $this->belongsToMany(Product::class)->withPivot('stock');
    }

    public function hasStock()
    {
        return  $this->products()
            ->where('stock', '>', 0)
            ->exists();
    }
    public function epmtyStock()
    {
        return $this->products()->update(['stock' => 0]);
    }

    public function updateStock($product_id, $stock)
    {
        return $this->products()->updateExistingPivot($product_id, ['stock' => $stock]);
    }

    public function getTotalCostOfProductsInStock()
    {
        return $this->products()->get();
    }
}
