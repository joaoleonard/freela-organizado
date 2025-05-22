<?php

namespace App\Providers;

use App\Helpers\WppConnectionApi;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(WppConnectionApi::class, function ($app) {  
            return new WppConnectionApi(config('services.wppconnect.url'), "freelaorganizado");
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
