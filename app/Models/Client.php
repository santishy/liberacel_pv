<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name','phone_number','address','email','company','assigned_price'];

    public function getRouteKeyName()
    {
        return 'phone_number';
    }
}
