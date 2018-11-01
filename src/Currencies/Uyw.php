<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Uyw extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return '';
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
        return 'Unidad Previsional';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '927';
    }
}
