<?php
declare(strict_types=1);

namespace EoneoPay\Currency\Locales;

use EoneoPay\Currency\Locale;

class EnAu extends Locale
{
    /**
     * Get the identifier for the current locale
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return 'en_AU';
    }

    /**
     * Get decimal separator
     *
     * @return string
     */
    protected function getDecimalSeparator(): string
    {
        return '.';
    }

    /**
     * Get thousands separator
     *
     * @return string
     */
    protected function getThousandsSeparator(): string
    {
        return ',';
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
        return "-\u{A4}#";
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
}
