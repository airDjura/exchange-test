<?php

namespace App\Services;

use App\Actions\Order\CreateOrderAction;
use App\Dto\Exchange\CalculateResultDto;
use App\Models\Currency;
use App\Models\Order;

class OrderService
{
    public function __construct(
        private ExchangeService $exchangeService,
        private CreateOrderAction $createOrderAction
    )
    {
    }


    public function order($fromCurrency, $toCurrency, $amount): Order
    {
        $result = $this->exchangeService->calculate($fromCurrency, $toCurrency, $amount);

        return $this->createOrderAction->createFromCalculationResult($result);
    }
}
