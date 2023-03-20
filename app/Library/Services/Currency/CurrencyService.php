<?php

namespace App\Library\Services\Currency;

use App\Library\Services\Currency\Enum\Currency;
use App\Library\Services\Currency\Exceptions\UnsupportedCurrencyException;
use App\Library\Services\Currency\Providers\AbstractProvider;
use App\Library\Services\Currency\Providers\ProviderA;
use App\Library\Services\Currency\Providers\ProviderB;

class CurrencyService
{
    /**
     * @var array[]
     */
    protected array $providers = [];

    public function __construct()
    {
        $this->addProvider((new ProviderA()))
            ->addProvider(new ProviderB());
    }

    /**
     * get min currency amount from currency services.
     *
     * @param Currency $currency
     * @return float
     * @throws UnsupportedCurrencyException
     */
    public function getMinAmount(Currency $currency): float
    {
        /** this validation deprecated because currency enum checks is valid. */
        if (!in_array($currency, Currency::ALLOWED_CURRENCIES)) {
            throw new UnsupportedCurrencyException($currency->value);
        }
        $amounts = [];

        /** @var AbstractProvider $provider */
        foreach ($this->providers as $provider) {
            if (!$provider->isAvailable()) {
                continue;
            }
            $amounts[] = $provider->fetch($currency->value);
        }

        return min($amounts);
    }

    public function addProvider(AbstractProvider $provider): self
    {
        $this->providers[] = $provider;
        return $this;
    }
}
