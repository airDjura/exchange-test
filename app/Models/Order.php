<?php

namespace App\Models;

use App\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $from_currency_id
 * @property int $to_currency_id
 * @property float $currency_rate
 * @property float $currency_surcharge_percentage
 * @property float $amount_of_currency_surcharge
 * @property float $amount_of_currency_purchased
 * @property float $amount_paid
 * @property float $discount_percentage
 * @property float $discount_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency $toCurrency
 * @property-read \App\Models\Currency $fromCurrency
 */
class Order extends Model
{
    use OrderTrait;

    protected $fillable = [
        'from_currency_id',
        'to_currency_id',
        'currency_rate',
        'currency_surcharge_percentage',
        'amount_of_currency_surcharge',
        'amount_of_currency_purchased',
        'amount_paid',
        'discount_percentage',
        'discount_amount',
    ];

    public function fromCurrency()
    {
        return $this->belongsTo(Currency::class, 'from_currency_id');
    }

    public function toCurrency()
    {
        return $this->belongsTo(Currency::class, 'to_currency_id');
    }
}
