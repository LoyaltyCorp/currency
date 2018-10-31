<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Afn extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{60b}";
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
        return 'Afghani';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '971';
    }
}
