<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Xbt extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{e3f}";
    }

    /**
     * @inheritdoc
     */
    public function getMinorUnit(): int
    {
        return 8;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'Bitcoin';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '-';
    }
}
