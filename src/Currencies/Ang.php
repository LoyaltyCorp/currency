<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Currencies;

use EoneoPay\Currencies\Currency;

class Ang extends Currency
{
    /**
     * @inheritdoc
     */
    public function getCurrencySymbol(): string
    {
        return "\u{192}";
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
        return 'Netherlands Antillian Guilder';
    }

    /**
     * @inheritdoc
     */
    public function getNumericCode(): string
    {
        return '532';
    }
}
