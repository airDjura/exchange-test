<?php

namespace App\Providers;

use App\Clients\CurrencyRates\CurrencyLayerClient;
use App\Services\CurrencyRatesService;
use Illuminate\Support\ServiceProvider;

class CurrencyRatesServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $weatherActiveClientConfig = config('currency.clients')[config('currency.default')];

        $client = new $weatherActiveClientConfig['class'];

        $this->app->singleton(
            CurrencyRatesService::class,
            fn() => new CurrencyRatesService($client)
        );
    }
}
