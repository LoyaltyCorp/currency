<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Locales;

use EoneoPay\Currencies\Locale;

class NlNl extends Locale
{
    /**
     * Get the identifier for the current locale
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return 'nl-NL';
    }

    /**
     * Get format for currency
     *
     * This uses placeholders for formatting numbers:
     *  - Hyphen/minus (-|\u{2D}) to denote where a negative symbol should go
     *  - Currency sign (¤|\u{A4}) to denote where a currency symbol should go
     *  - Number sign (#|\u{23}) to denote where the formatted number should go
     *
     * @return string
     */
    protected function getCurrencyFormat(): string
    {
        return "\u{A4} -#";
    }

    /**
     * Get decimal separator
     *
     * @return string
     */
    protected function getDecimalSeparator(): string
    {
        return ',';
    }

    /**
     * Get negative value symbol
     *
     * @return string
     */
    protected function getNegativeSymbol(): string
    {
        return '-';
    }

    /**
     * Get numeric format
     *
     * This uses placeholders for formatting numbers:
     *  - Hyphen/minus (-|\u{2D}) to denote where a negative symbol should go
     *  - Number sign (#|\u{23}) to denote where the formatted number should go
     *
     * @return string
     */
    protected function getNumericFormat(): string
    {
        return '-#';
    }

    /**
     * Get thousands separator
     *
     * @return string
     */
    protected function getThousandsSeparator(): string
    {
        return '.';
    }
}
