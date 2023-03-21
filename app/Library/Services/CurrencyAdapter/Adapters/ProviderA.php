<?php

namespace App\Library\Services\CurrencyAdapter\Adapters;

use App\Library\Services\Currency\Enum\Currency;
use App\Library\Services\CurrencyAdapter\Provider;
use App\Library\Services\CurrencyAdapter\ProviderInterface;

class ProviderA implements ProviderInterface
{
    public function __construct(protected Provider $provider)
    {

    }

    public function fetch(Currency $currency): float
    {
        $response = $this->provider->fetchCurrencies();

        return collect($response['result'])
            ->where('symbol', $this->currencyMapping()[$currency->value])
            ->first()['amount'];
    }

    public function currencyMapping(): array
    {
        return [
            Currency::USD->value => 'USDTRY',
            Currency::EUR->value => 'EURTRY',
            Currency::GBP->value => 'GBPTRY',
        ];
    }
}
