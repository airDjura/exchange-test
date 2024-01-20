<?php

namespace Tests\Feature\Api\Currencies;

use Tests\TestCase;

class CalculateTest extends TestCase
{
    protected function callEndpoint($params = []): \Illuminate\Testing\TestResponse
    {
        return $this->json('GET', 'api/currencies/exchange/calculate', $params, [
            'Accept' => 'application/json',
        ]);
    }

    public function test_if_returns_a_expected_response()
    {
        $response = $this->callEndpoint([
            'fromCurrency' => 'USD',
            'toCurrency' => 'EUR',
            'amount' => 100,
        ]);

        $response->assertJsonStructure([
            'data' => [
                'fromCurrency',
                'toCurrency',
                'totalAmount',
            ],
        ]);
    }

    public function test_it_fails_on_invalid_amount()
    {
        $response = $this->callEndpoint([
            'fromCurrency' => 'USD',
            'toCurrency' => 'EUR',
            'amount' => 0,
        ]);

        $response->assertStatus(422)->assertJsonStructure([
            'message',
            'errors' => [
                'amount',
            ],
        ]);
    }

    public function test_it_fails_on_invalid_currency()
    {
        $response = $this->callEndpoint([
            'fromCurrency' => 'USD',
            'toCurrency' => 'INVALID_CURRENCY',
            'amount' => 0,
        ]);

        $response->assertStatus(422)->assertJsonStructure([
            'message',
            'errors' => [
                'toCurrency',
            ],
        ]);
    }
}
