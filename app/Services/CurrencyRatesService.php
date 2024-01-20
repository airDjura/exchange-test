<?php

namespace App\Services;

use App\Contracts\Clients\ExchangeRates\CurrencyClient;
use App\Dto\Clients\CurrencyRates\CurrencyRatesDataDto;

class CurrencyRatesService
{
    public function __construct(private CurrencyClient $client)
    {
    }

    public function getRates(): CurrencyRatesDataDto
    {
        return $this->client->getRates();
    }
}
