<?php

namespace App\Library\Services\CurrencyAdapter;

use App\Library\Services\Currency\Enum\Currency;

interface ProviderInterface
{
    public function fetch(Currency $currency): float;

    public function currencyMapping(): array;
}
