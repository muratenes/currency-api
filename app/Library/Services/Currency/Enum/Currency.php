<?php

namespace App\Library\Services\Currency\Enum;

enum Currency : string
{
    case  USD = 'USD';
    case  EUR = 'EUR';
    case  GBP = 'GBP';


    const ALLOWED_CURRENCIES = [
        self::USD,
        self::EUR,
        self::GBP,
    ];
}
