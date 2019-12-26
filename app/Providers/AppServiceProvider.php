<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GuzzleHttp\ClientInterface', function () {
            #return new Client();
            return new Client([
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'UTF-8']
                ]);
        });
    }
}
