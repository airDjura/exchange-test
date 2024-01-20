<?php

namespace App\Dto\Clients\CurrencyRates;

use App\Dto\Weather\Clients\CurrentWeatherDto;
use App\Dto\Weather\Clients\ForecastDto;
use App\Dto\Weather\Clients\ForecastTempDto;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CurrencyRatesDataDto extends Data
{
    public function __construct(
        public string         $sourceCurrencyName,
        #[DataCollectionOf(CurrencyQuoteDataDto::class)]
        public DataCollection $quotes,

    )
    {
    }


    public static function fromCurrencyLayerResponse(array $data): self
    {
        $quotesData = [];

        foreach ($data['quotes'] as $key => $value) {
            $quotesData[] = new CurrencyQuoteDataDto(
                substr($key, 0, 3),
                substr($key, 3, 3),
                $value,
            );
        }

        $quotesDataCollection = CurrencyQuoteDataDto::collection($quotesData);

        return new self($data['source'], $quotesDataCollection);
    }
}
