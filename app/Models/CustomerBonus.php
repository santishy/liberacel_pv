<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerBonus extends Model
{
    use HasFactory;
    
    public function scorePoints(){
        $this->getQuickSalePoints()->productBonuses()
            ->sum(DB::raw('product_bonuses.points * fast_sale_product_bonus.qty'));
    }

    public function getQuickSalePoints(){
        return FastSale::find(request('fast_sale_id'));
    }
}
