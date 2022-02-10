<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class Commission extends Model
{
    use HasFactory;
    protected $fillable = ['amount','fast_sale_id'];

    public function fast_sales(){
        return $this->belongsTo(FastSale::class,'fast_sale_id');
    }
    public function scopeBySales($query,$value){
        $query->with(['fastSales' => function($sql) use ($value){
            $sql->where('user_id',(int)$value);
        }]);
    }
    public function scopeWeek(Builder $query, $value)
    {
        $query->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }
    public function scopeBetweenDates(Builder $query,$value){

        $dates = str::of($value)->explode(',');
        
        $query->whereBetween(DB::raw('Date(created_at)'),[$dates[0],$dates[1]]);

    }
}
