<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'description', 'status', 'start_date', 'end_date', 'min_sale_total', 'inventory_id','total_numbers'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public static function activeForInventory($inventoryId)
    {
        return self::where('inventory_id', $inventoryId)
            ->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
    }
}
