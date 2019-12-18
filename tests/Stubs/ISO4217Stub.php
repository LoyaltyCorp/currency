<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currencies\Stubs;

use EoneoPay\Currencies\Currencies\Usd;
use EoneoPay\Currencies\Interfaces\CurrencyInterface;
use EoneoPay\Currencies\Interfaces\ISO4217Interface;

class ISO4217Stub implements ISO4217Interface
{
    /**
     * {@inheritdoc}
     */
    public function find(string $code): CurrencyInterface
    {
        return new Usd();
    }

    /**
     * {@inheritdoc}
     */
    public function getSupportedAlphaCodes(): array
    {
        return ['USD'];
    }
}
