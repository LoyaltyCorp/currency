<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Clf extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{55}\u{46}";
    }

    /**
     * @inheritdoc
     */
    public function getMinorUnit(): int
    {
        return 4;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'Unidad de Fomento';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '990';
    }
}
