<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Locales;

use EoneoPay\Currencies\Locale;

class ArOm extends Locale
{
    /**
     * Set translation mapping
     */
    public function __construct()
    {
        // Override translation mapping to use arabic numbers
        $this->translations = [
            0 => "\u{660}",
            1 => "\u{661}",
            2 => "\u{662}",
            3 => "\u{663}",
            4 => "\u{664}",
            5 => "\u{665}",
            6 => "\u{666}",
            7 => "\u{667}",
            8 => "\u{668}",
            9 => "\u{669}"
        ];
    }

    /**
     * Get the identifier for the current locale
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return 'ar-OM';
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
        return "-# \u{A4}";
    }

    /**
     * Get decimal separator
     *
     * @return string
     */
    protected function getDecimalSeparator(): string
    {
        return "\u{66B}";
    }

    /**
     * Get negative value symbol
     *
     * @return string
     */
    protected function getNegativeSymbol(): string
    {
        return "\u{61c}-";
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
        return "\u{66C}";
    }

    /**
     * Get translation mapping for demical -> arabic numbers
     *
     * @return string[]
     */
    protected function getTranslationMapping(): array
    {
        return [
            0 => "\u{660}",
            1 => "\u{661}",
            2 => "\u{662}",
            3 => "\u{663}",
            4 => "\u{664}",
            5 => "\u{665}",
            6 => "\u{666}",
            7 => "\u{667}",
            8 => "\u{668}",
            9 => "\u{669}"
        ];
    }
}
