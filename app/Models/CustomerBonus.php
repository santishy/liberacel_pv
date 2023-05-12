<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerBonus extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'fast_sale_id', 'accumulated_points', 'status'];

    public function addFastSale($fastSale)
    {

        if (is_null($fastSale->customer_bonus_id)) {
            $this->fastSales()->save($fastSale);
        }
        return;
    }
    public function scorePoints($fastSale = null)
    {

        if (is_null($fastSale)) {
            $fastSale = $this->getFastSale();
        }

        if ($fastSale->status != 'completed') {
            return;
        }
        $this->accumulated_points += $this->getPoints($fastSale);
        $this->save();
        return $this;
    }

    public function getPoints($fastSale)
    {

        if (is_null($fastSale->customer_bonus_id))
            return 0;

        return $fastSale->productBonuses()
            ->sum(DB::raw('product_bonuses.points * fast_sale_product_bonus.qty'));
    }

    public function getFastSale($id = null)
    {
        return FastSale::find(request('fast_sale_id', $id));
    }
    public function fastSales()
    {
        return $this->hasMany(FastSale::class);
    }

    public function getElectronicMoney($pointData)
    {
        return $this->accumulated_points * floatval($pointData->value);
    }

    public function conversionToPoints($pointData,$value){
        if($value == 0)/**Revisar aqui, me marcaba un error por division entre 0 , al parecer si en ventas
        rapidas buscas un cliente como 3531097842 y no tiene puntos acumulados, y le pones borrar entonces marca este error */
            return;
        return $value / floatval($pointData->value);
    }
}
