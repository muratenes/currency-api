<?php

namespace App\Library\Services\Currency\Exceptions;

class UnsupportedCurrencyException extends \Exception
{
    public function __construct(string $currency = '')
    {
        parent::__construct("Provided currency not allowed : " . $currency);
    }
}
