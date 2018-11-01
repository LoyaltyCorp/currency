<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Vuv extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{56}\u{54}";
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
        return 'Vatu';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '548';
    }
}
