<?php

namespace App\Console\Commands\Daily;

use App\Actions\Currencies\UpdateCurrenciesAction;
use App\Dto\Clients\CurrencyRates\CurrencyRatesDataDto;
use App\Services\CurrencyRatesService;
use Illuminate\Console\Command;

class UpdateCurrencyRatesCommand extends Command
{
    protected $signature = 'currency:update-rates';

    protected $description = 'Update currency rates';

    public function handle(CurrencyRatesService $currencyRatesService, UpdateCurrenciesAction $updateCurrenciesAction): void
    {

        $this->info('Fetching currency rates...');

        $currencyRates = $currencyRatesService->getRates();

        $this->info('Currency rates fetched successfully!');

        $this->info('Updating currency rates...');

        $updateCurrenciesAction->fromCurrencyRatesResponse($currencyRates);

        $this->info('Currency rates updated!');
    }
}
