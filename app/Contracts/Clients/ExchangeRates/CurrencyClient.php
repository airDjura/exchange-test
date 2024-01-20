<?php

namespace App\Contracts\Clients\ExchangeRates;
use App\Dto\Clients\CurrencyRates\CurrencyRatesDataDto;

interface CurrencyClient
{
    public function getRates(): CurrencyRatesDataDto;
}
