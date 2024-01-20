<?php

namespace App\Dto\Clients\CurrencyRates;

use App\Dto\Weather\Clients\CurrentWeatherDto;
use App\Dto\Weather\Clients\ForecastDto;
use App\Dto\Weather\Clients\ForecastTempDto;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CurrencyQuoteDataDto extends Data
{
    public function __construct(
        public string $from,
        public string $to,
        public string $rate,
    )
    {
    }
}
