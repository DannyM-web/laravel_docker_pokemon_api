<?php

namespace App\Providers;

use App\Services\Caller;
use Illuminate\Support\ServiceProvider;

class CallerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Caller::class, function ($app) {
            return new Caller('https://pokeapi.co/api/v2/pokemon/');
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
