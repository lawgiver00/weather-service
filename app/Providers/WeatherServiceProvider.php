<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Library\Services\Weather;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Library\Services\Contracts\WeatherServiceInterface', function ($app) {
            return new Weather();
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
