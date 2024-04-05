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
    public function generate_doc_no($last_count)
    {
        $prefix = 'DOCNO' . date('ymd');
        $doc_no = $prefix . $last_count + 1;
        return $doc_no;
    }
}
