<?php

namespace App\Http\Resources\Api\Exchange;

use App\Dto\Exchange\CalculateResultDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/* @property-read CalculateResultDto $resource */
class CalculationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'fromCurrency' => $this->resource->fromCurrency->name,
            'toCurrency' => $this->resource->toCurrency->name,
            'totalAmount' => $this->resource->totalAmount
        ];
    }
}
