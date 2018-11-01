<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Kwd extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{643}\u{2e}\u{62f}";
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
        return 'Kuwaiti Dinar';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '414';
    }
}
