<?php

namespace App\Http\Controllers\Api\Currencies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Currencies\Exchange\ExchangeCalculateRequest;
use App\Http\Resources\Api\Exchange\CalculationResource;
use App\Services\ExchangeService;
use App\Services\OrderService;

class ExchangeController extends Controller
{
    public function calculate(ExchangeCalculateRequest $request, ExchangeService $exchangeCalculateService)
    {
        $fromCurrency = $request->get('fromCurrency');
        $toCurrency = $request->get('toCurrency');
        $amount = $request->get('amount');

        return new CalculationResource($exchangeCalculateService->calculate($fromCurrency, $toCurrency, $amount));
    }

    public function order(ExchangeCalculateRequest $request, OrderService $orderService)
    {
        $fromCurrency = $request->get('fromCurrency');
        $toCurrency = $request->get('toCurrency');
        $amount = $request->get('amount');

        $orderService->order($fromCurrency, $toCurrency, $amount);

        return response(['message' => 'Order created'], 201);
    }
}
