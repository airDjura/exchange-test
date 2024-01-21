<?php

namespace App\Clients\CurrencyRates;

use App\Contracts\Clients\ExchangeRates\CurrencyClient;
use App\Dto\Clients\CurrencyRates\CurrencyRatesDataDto;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;

class CurrencyLayerClient implements CurrencyClient
{
    protected array $config;
    protected PendingRequest $client;
    public function __construct()
    {
        $this->config = config('currency.clients.currency_layer');

        $this->client = Http::withOptions(
            [
                'query' => ['access_key' => $this->config['api_key']],
            ]
        )
            ->baseUrl('http://apilayer.net/api');
    }

    public function getRates(): CurrencyRatesDataDto
    {
        $currencies = implode(',', array_keys(config('currency.currencies')));

        $response = $this->client->get('/live', [
            'source' => config('currency.source_currency'),
            'currencies' => $currencies,
            'format' => 1,
        ]);

        $responseData = json_decode($response, true);

        if (!$responseData['success']) {
            throw new HttpResponseException(response($responseData, 500));
        }

        return CurrencyRatesDataDto::fromCurrencyLayerResponse($responseData);;
    }
}
