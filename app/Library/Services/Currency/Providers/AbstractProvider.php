<?php

namespace App\Library\Services\Currency\Providers;

use Illuminate\Support\Facades\Http;

abstract class AbstractProvider
{
    /*
     * this variable created for singleton api request.
     */
    private static array $apis = [];

    /**
     * You can disable service dynamically from db or any condition.
     * @return bool
     */
    public function isAvailable(): bool
    {
        return true;
    }

    protected function getCurrencies(): array
    {
        if (!isset(self::$apis[$this->getUrl()])) {
            self::$apis[$this->getUrl()] = Http::get($this->getUrl())->json();
        }

        return self::$apis[$this->getUrl()];
    }

}
