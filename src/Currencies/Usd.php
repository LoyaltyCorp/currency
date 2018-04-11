<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Usd extends Currency
{
    /**
     * Get the currency symbol for this currency
     *
     * @return string
     */
    public function getCurrencySymbol(): string
    {
        return "\u{24}";
    }

    /**
     * Get the minor unit for this currency
     *
     * @return int
     */
    public function getMinorUnit(): int
    {
        return 2;
    }

    /**
     * Get the currency name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'United States Dollar';
    }

    /**
     * Get the numeric code for this currency
     *
     * @return string
     */
    public function getNumericCode(): string
    {
        return '840';
    }
}
