<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currencies\Stubs;

use EoneoPay\Currencies\Currency;

class CurrencyStub0 extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{1d530}";
    }

    /**
     * @inheritdoc
     */
    public function getMinorUnit(): int
    {
        return 10;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'Dollarydoo';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '123';
    }
}
