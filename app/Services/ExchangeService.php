<?php

namespace App\Services;

use App\Actions\Order\CreateOrderAction;
use App\Dto\Exchange\CalculateResultDto;
use App\Models\Currency;

class ExchangeService
{
    public function __construct(
        private CreateOrderAction $createOrderAction)
    {
    }

    public function calculate($fromCurrency, $toCurrency, $amount): CalculateResultDto
    {
        $fromCurrency = Currency::where('name', $fromCurrency)->first();
        $toCurrency = Currency::where('name', $toCurrency)->first();

        // get exchange rate of the currency
        $exchangeRate = $fromCurrency->currencyRates()->where('to_currency_id', $toCurrency->id)->first();

        // get config of the currency
        $currencyConfig = config('currency.currencies')[$toCurrency->name];

        $discount = $currencyConfig['discount'];

        $result = ($amount * 1 / $exchangeRate->rate);

        // calculate surcharge amount
        $surchargeAmount = $result * $toCurrency->surcharge;

        $totalAmount = $result + $surchargeAmount;

        $discountAmount = ($totalAmount * $discount);

        $totalAmountWithDiscount = $totalAmount - $discountAmount;

        return new CalculateResultDto(
            $fromCurrency,
            $toCurrency,
            $exchangeRate->rate,
            $totalAmountWithDiscount,
            $amount,
            $toCurrency->surcharge,
            $surchargeAmount,
            $discount,
            $discountAmount
        );
    }
}
