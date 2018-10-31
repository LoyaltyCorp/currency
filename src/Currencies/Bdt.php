<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Bdt extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{9f3}";
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
        return 'Taka';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '050';
    }
}
