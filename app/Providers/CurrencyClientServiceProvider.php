<?php

namespace App\Providers;

use App\Contracts\Clients\ExchangeRates\CurrencyClient;
use Illuminate\Support\ServiceProvider;

class CurrencyClientServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            CurrencyClient::class,
            config('currency.clients')[config('currency.default')]['class']
        );
    }

    public function boot(): void
    {
    }
}
