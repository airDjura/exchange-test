<?php

namespace App\Traits;

use App\Mail\OrderCreatedMail;
use App\Models\Order;
use Mail;

/**
 * Created by PhpStorm.
 * User: neville.woller
 * Date: 7/23/17
 * Time: 4:06 PM
 */
trait OrderTrait
{

    /**
     * Binds creating/saving events to create UUIDs (and also prevent them from being overwritten).
     *
     * @return void
     */
    public static function bootOrderTrait()
    {

        static::created(
            function (Order $model) {
                if (config('currency.currencies')[$model->toCurrency->name]['emailNotification']) {
                    Mail::to(config('currency.sendTo'))->send(new OrderCreatedMail($model));
                }
            }
        );
    }

}
