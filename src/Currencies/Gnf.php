<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Gnf extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{46}\u{47}";
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
        return 'Guinean Franc';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '324';
    }
}
