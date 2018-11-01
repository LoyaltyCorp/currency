<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Krw extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{20a9}";
    }

    /**
     * @inheritdoc
     */
    public function getMinorUnit(): int
    {
        return 0;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'Won';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '410';
    }
}
