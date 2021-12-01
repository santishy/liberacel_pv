<?php

namespace App\Providers;

use App\Authorization\CurrentUser;
use App\Gates\StockValidations;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CurrentUser',CurrentUser::class);
        $this->app->bind('stockValidations',function(){
            return new StockValidations();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
