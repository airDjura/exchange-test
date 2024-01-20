<?php

namespace App\Actions\Currencies;

use App\Dto\Clients\CurrencyRates\CurrencyRatesDataDto;
use App\Models\Currency;
use App\Models\CurrencyRate;
use JetBrains\PhpStorm\NoReturn;

class UpdateCurrenciesAction
{
    public function __construct()
    {
    }

    #[NoReturn] public function fromCurrencyRatesResponse(CurrencyRatesDataDto $data): void
    {

        $data->quotes->each(function ($quote) {
            // update source available currencies if they are not exist

            $currencyFrom = Currency::firstOrCreate([
                'name' => $quote->from,
            ]);

            $currencyTo = Currency::firstOrCreate([
                'name' => $quote->to,
            ]);

            // update currency rates
            CurrencyRate::updateOrCreate([
                'from_currency_id' => $currencyFrom->id,
                'to_currency_id' => $currencyTo->id,
            ], [
                'from_currency_id' => $currencyFrom->id,
                'to_currency_id' => $currencyTo->id,
                'rate' => $quote->rate,
            ]);
        });
    }
}
