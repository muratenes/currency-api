<?php

namespace App\Library\Services\CurrencyAdapter;

use App\Library\Services\Currency\Enum\Currency;
use App\Library\Services\CurrencyAdapter\Adapters\ProviderA;
use App\Library\Services\CurrencyAdapter\Adapters\ProviderB;

class CurrencyService
{
    /**
     * @var array[]
     */
    protected array $providers = [];

    public function __construct()
    {
        $this->addProvider((new ProviderA(new Provider("http://www.mocky.io/v2/5a74519d2d0000430bfe0fa0"))))
            ->addProvider(new ProviderB(new Provider("http://www.mocky.io/v2/5a74524e2d0000430bfe0fa3")));
    }

    /**
     * get min currency amount from currency services.
     *
     * @param Currency $currency
     * @return float
     */
    public function getMinAmount(Currency $currency): float
    {
        $amounts = [];

        /** @var ProviderInterface $provider */
        foreach ($this->providers as $provider) {
            $amounts[] = $provider->fetch($currency);
        }

        return min($amounts);
    }

    public function addProvider(ProviderInterface $provider): self
    {
        $this->providers[] = $provider;
        return $this;
    }
}
