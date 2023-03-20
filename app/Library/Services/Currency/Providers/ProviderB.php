<?php

namespace App\Library\Services\Currency\Providers;

use App\Library\Services\Currency\Enum\Currency;
use App\Library\Services\Currency\Provider;

class ProviderB extends AbstractProvider implements Provider
{
    public function getUrl(): string
    {
        return "http://www.mocky.io/v2/5a74524e2d0000430bfe0fa3";
    }

    public function fetch(string $currency): float
    {
        $response = $this->getCurrencies();

        return collect($response)->where('kod', $this->currencyMapping()[$currency])->first()['oran'];
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
