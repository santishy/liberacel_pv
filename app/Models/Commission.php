<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Commission extends Model
{
    use HasFactory;
    protected $fillable = ['amount', 'fast_sale_id'];

    public function fastSale()
    {
        return $this->belongsTo(FastSale::class);
    }
    public function scopeWeeklyCommissions($query, $field)
    {
        $query->whereBetween('commissions.created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]);
    }
    public function scopeCommissionsBetweenDates($query, $value)
    {

        $dates = str::of($value)->explode(',');
        $query->whereBetween(DB::raw('Date(commissions.created_at)'), [$dates[0], $dates[1]]);
    }
    public function scopeCompletedStatus($query, $value)
    {
        $query->where('status', $value);
    }
    public function fastSellingProducts($products){
        
    }
}
