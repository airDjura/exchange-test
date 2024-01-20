<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        $initialCurrencies = config('currency.currencies');

        foreach ($initialCurrencies as $name => $currency) {
            \App\Models\Currency::updateOrCreate([
                'name' => $name,
            ],
                [
                    'name' => $name,
                    'surcharge' => $currency['surcharge'],
                ]);
        }


    }
}
