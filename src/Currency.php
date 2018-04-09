<?php
declare(strict_types=1);

namespace EoneoPay\Currency;

use EoneoPay\Currency\Interfaces\CurrencyInterface;

abstract class Currency implements CurrencyInterface
{
    /**
     * Get the alphabetic code for this currency
     *
     * @return string
     */
    public function getAlphaCode(): string
    {
        // Get class extending currency, base class name will match alpha code
        return \mb_strtoupper(\substr(\strrchr(\get_class($this), '\\'), 1));
    }
}
