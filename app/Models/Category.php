<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function scopeSearch(Builder $query,$value){
        $values = Str::of($value)->explode(' ');
        foreach($values as $value){
            $query->orWhere('name','LIKE',"%{$value}%");
        }
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}
