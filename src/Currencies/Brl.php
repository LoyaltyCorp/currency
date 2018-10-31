<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Brl extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{52}\u{24}";
    }

    /**
     * @inheritdoc
     */
    public function getMinorUnit(): int
    {
        return 2;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'Brazil Real';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '986';
    }
}
