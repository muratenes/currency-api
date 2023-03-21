<?php

namespace App\Library\Services\CurrencyAdapter\Adapters;

use App\Library\Services\Currency\Enum\Currency;
use App\Library\Services\CurrencyAdapter\Provider;
use App\Library\Services\CurrencyAdapter\ProviderInterface;

class ProviderB implements ProviderInterface
{
    public function __construct(protected Provider $provider)
    {

    }

    public function fetch(Currency $currency): float
    {
        $response = $this->provider->fetchCurrencies();

        return collect($response)->where('kod', $this->currencyMapping()[$currency->value])->first()['oran'];
    }

    public function currencyMapping(): array
    {
        return [
            Currency::USD->value => 'DOLAR',
            Currency::EUR->value => 'AVRO',
            Currency::GBP->value => 'İNGİLİZ STERLİNİ'
        ];
    }
}
