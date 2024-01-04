<?php

namespace App\Helpers;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

class RupiahFormatterHelper
{
    public static function format($amount)
    {
        $money = new Money($amount, new Currency('IDR')); // Menggunakan mata uang IDR (Rupiah)
        $currencies = new ISOCurrencies();

        $formatter = new IntlMoneyFormatter(
            new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY),
            $currencies
        );

        return $formatter->format($money);
    }
}
