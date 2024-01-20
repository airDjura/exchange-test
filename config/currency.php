<?php

use Illuminate\Support\Str;

return [
    // Default third party client
    'default' => env('CURRENCY_CLIENT', 'currency_layer'),

    'sendTo' => env('EXCHANGE_ORDER_EMAIL', 'order@example.com'),

    // All available third party clients
    'clients' => [
        'currency_layer' => [
            'class' => App\Clients\CurrencyRates\CurrencyLayerClient::class,
            'api_key' => env('CURRENCY_LAYER_API_KEY'),
            'source_currency' => 'USD',
        ]
    ],

    // All available currencies with options
    'currencies' => [
        'USD' => [
            'surcharge' => 0,
            'emailNotification' => false,
            'discount' => 0
        ],
        'JPY' => [
            'surcharge' => 0.075,
            'emailNotification' => false,
            'discount' => 0
        ],
        'EUR' => [
            'surcharge' => 0.05,
            'emailNotification' => false,
            'discount' => 0.02
        ],
        'GBP' => [
            'surcharge' => 0.05,
            'emailNotification' => true,
            'discount' => 0
        ],
    ]
];
