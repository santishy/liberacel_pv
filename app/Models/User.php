<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'inventory_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fastSales(){
        return $this->hasMany(FastSale::class);
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
