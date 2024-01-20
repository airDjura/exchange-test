<?php

namespace App\Dto\Exchange;

use App\Dto\Weather\Clients\CurrentWeatherDto;
use App\Dto\Weather\Clients\ForecastDto;
use App\Dto\Weather\Clients\ForecastTempDto;
use App\Models\Currency;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CalculateResultDto extends Data
{
    public function __construct(
        public Currency $fromCurrency,
        public Currency $toCurrency,
        public float $currencyRate,
        public float $totalAmount,
        public float $toCurrencyAmount,
        public float $surcharge,
        public float $surchargeAmount,
        public float $discount,
        public float $discountAmount,
    )
    {
    }
}
