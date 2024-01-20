<?php

namespace App\Actions\Order;

use App\Dto\Exchange\CalculateResultDto;
use App\Models\Order;

class CreateOrderAction
{
    public function createFromCalculationResult(CalculateResultDto $data): Order
    {
        // create order
        return Order::create([
             'from_currency_id' => $data->fromCurrency->id,
             'to_currency_id' => $data->toCurrency->id,
             'amount_paid' => $data->totalAmount,
             'currency_rate' => $data->currencyRate,
             'amount_of_currency_purchased' => $data->toCurrencyAmount,
             'currency_surcharge_percentage' => $data->surcharge,
             'amount_of_currency_surcharge' => $data->surchargeAmount,
             'discount_percentage' => $data->discount,
             'discount_amount' => $data->discountAmount,
         ]);
    }
}
