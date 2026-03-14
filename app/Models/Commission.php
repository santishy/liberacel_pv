<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'user_id'];

    public function commissionable()
    {
        return $this->morphTo();
    }

    public function fastSale()
    {
        return $this->belongsTo(FastSale::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function scopeComissionsFromFridayToThursday($query, $field)
    {
        $friday = new Carbon('last friday');
        $thursday = new Carbon('thursday');
        $query->whereBetween('commissions.created_at', [
            $friday,
            $thursday,
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

    public function fastSellingProducts($products)
    {
        return collect($products)->map(function ($product) {
            return [
                'Descripcion' => $product->description,
                'Cantidad' => $product->qty,
                'Precio' => $product->price,
            ];
        });
    }
}
