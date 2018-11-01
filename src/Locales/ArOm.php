<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Locales;

use EoneoPay\Currencies\Interfaces\Locales\TranslatableInterface;
use EoneoPay\Currencies\Locale;

class ArOm extends Locale implements TranslatableInterface
{
    /**
     * @inheritdoc
     */
    public function getIdentifier(): string
    {
        return 'ar-OM';
    }

    /**
     * @inheritdoc
     */
    public function getTranslationMapping(): array
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

    /**
     * @inheritdoc
     */
    protected function getCurrencyFormat(): string
    {
        return "-# \u{A4}";
    }

    /**
     * @inheritdoc
     */
    protected function getDecimalSeparator(): string
    {
        return "\u{66B}";
    }

    /**
     * @inheritdoc
     */
    protected function getNegativeSymbol(): string
    {
        return "\u{61c}-";
    }

    /**
     * @inheritdoc
     */
    protected function getNumericFormat(): string
    {
        return '-#';
    }

    /**
     * @inheritdoc
     */
    protected function getThousandsSeparator(): string
    {
        return "\u{66C}";
    }
}
