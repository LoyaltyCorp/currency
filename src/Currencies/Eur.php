<?php
declare(strict_types=1);

namespace EoneoPay\Currency\Currencies;

use EoneoPay\Currency\Currency;

class Eur extends Currency
{
    /**
     * Get the currency symbol for this currency
     *
     * @return string
     */
    public function getCurrencySymbol(): string
    {
        return "\u{20ac}";
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
        return 'Euro';
    }

    /**
     * Get the numeric code for this currency
     *
     * @return string
     */
    public function getNumericCode(): string
    {
        return '978';
    }
}
