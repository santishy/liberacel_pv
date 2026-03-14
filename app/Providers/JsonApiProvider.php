<?php

namespace App\Providers;

use App\JsonApi\JsonApiBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class JsonApiProvider extends ServiceProvider
{
    public function register() {}

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::mixin(new JsonApiBuilder);
    }
}
