<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currencies\Stubs;

use EoneoPay\Currencies\Currency;

class CurrencyStub extends Currency
{
    /**
     * Get the currency symbol for this currency
     *
     * @return string
     */
    public function getCurrencySymbol(): string
    {
        return "\u{1d530}";
    }

    /**
     * Get the minor unit for this currency
     *
     * @return int
     */
    public function getMinorUnit(): int
    {
        return 10;
    }

    /**
     * Get the currency name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Dollarydoo';
    }

    /**
     * Get the numeric code for this currency
     *
     * @return string
     */
    public function getNumericCode(): string
    {
        return '123';
    }
}
