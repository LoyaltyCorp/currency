<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Bhd extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{2e}\u{628}\u{2e}\u{62f}";
    }

    /**
     * @inheritdoc
     */
    public function getMinorUnit(): int
    {
        return 3;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'Bahraini Dinar';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '048';
    }
}
