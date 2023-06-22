<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    public function creditables()
    {
        return $this->hasMany(Creditable::class);
    }

    public function sales()
    {
        return $this->morphedByMany(Sale::class, 'creditable');
    }

    public function fastSales()
    {
        return $this->morphedByMany(FastSale::class, 'creditable');
    }
}
