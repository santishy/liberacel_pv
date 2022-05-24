<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerBonus extends Model
{
    use HasFactory;

    protected $fillable=['phone_number','fast_sale_id','accumulated_points','status'];

    public function addFastSale($fastSale){
        
        if(is_null($fastSale->customer_bonus_id)){
            $this->fastSales()->save($fastSale);
        }
        return;
    }
    public function scorePoints()
    {
        $fastSale = $this->getFastSale();
        if($fastSale->status != 'completed'){
            return;
        }
        $this->accumulated_points += $this->getPoints($fastSale);
        $this->save();
        return $this->fresh();
    }

    public function getPoints($fastSale ){
        
        

        if(!is_null($fastSale->customer_bonus_id))
            return 0;

        return $fastSale->productBonuses()
        ->sum(DB::raw('product_bonuses.points * fast_sale_product_bonus.qty'));
    }

    public function getFastSale()
    {
        $id = request()->has('fast_sale_id') ? request('fast_sale_id') : request('id');
        return FastSale::find($id);
    }
    public function fastSales(){
        return $this->hasMany(FastSale::class);
    }
    
}
