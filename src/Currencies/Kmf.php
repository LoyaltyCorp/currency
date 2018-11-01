<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Kmf extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{43}\u{46}";
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
        return 'Comorian Franc';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '174';
    }
}
