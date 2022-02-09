<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $fillable = ['amount','fast_sale_id'];

    public function fastSales(){
        return $this->belongsTo(FastSale::class);
    }
    public function scopeBySales($query){
        return $query->with(['fastSales' => function($sql) {
            $sql->where('user_id',request('user_id'));
        }]);
    }
    public function scopeWeek(Builder $query, $value)
    {
        $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }
}
