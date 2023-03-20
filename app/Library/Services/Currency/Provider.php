<?php

namespace App\Library\Services\Currency;

interface Provider
{
    public function getUrl(): string;

    public function currencyMapping(): array;

    public function isAvailable(): bool;

}
