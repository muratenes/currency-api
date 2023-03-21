<?php

namespace App\Library\Services\CurrencyAdapter;

use Illuminate\Support\Facades\Http;

class Provider
{

    /*
    * this variable created for caching api responses.
    */
    private static array $apis = [];

    public function __construct(protected string $url)
    {
    }

    public function fetchCurrencies(): array
    {
        if (!isset(self::$apis[$this->url])) {
            self::$apis[$this->url] = Http::get($this->url)->json();
        }

        return self::$apis[$this->url];
    }
}
