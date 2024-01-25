<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBonus extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'points', 'status', 'commission_amount'];
}
