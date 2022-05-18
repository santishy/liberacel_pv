<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerBonus extends Model
{
    use HasFactory;

    protected $fillable=['phone_number','fast_sale_id','accumulated_points','status'];

    public function scorePoints()
    {
        $this->accumulated_points += $this->getPoints();
        $this->save();
    }

    public function getPoints(){
        
        $fastSale = $this->getQuickSalePoints();

        if(!is_null($fastSale->customer_bonus_id))
            return 0;

        $this->fastSales()->associate($fastSale);

        return $fastSale->productBonuses()
        ->sum(DB::raw('product_bonuses.points * fast_sale_product_bonus.qty'));
    }

    public function getQuickSalePoints()
    {
        return FastSale::find(request('fast_sale_id'));
    }
    public function fastSales(){
        return $this->hasMany(FastSale::class);
    }
}
