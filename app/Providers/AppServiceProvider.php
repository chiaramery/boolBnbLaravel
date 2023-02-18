<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function ($app) {
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => '85nhpwwpnccwsx5p',
                    'publicKey' => 'jm839g83gk6gh9dw',
                    'privateKey' => '74deb2164721505425407ff9d8a6bd65'
                ]
            );
        });
    }
}
