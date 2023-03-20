<?php

namespace App\Library\Services\Currency\Providers;

use App\Library\Services\Currency\Enum\Currency;
use App\Library\Services\Currency\Provider;

class ProviderA extends AbstractProvider implements Provider
{
    public function getUrl(): string
    {
        return "http://www.mocky.io/v2/5a74519d2d0000430bfe0fa0";
    }

    public function fetch(string $currency): float
    {
        $response = $this->getCurrencies();

        return collect($response['result'])->where('symbol', $this->currencyMapping()[$currency])->first()['amount'];
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
