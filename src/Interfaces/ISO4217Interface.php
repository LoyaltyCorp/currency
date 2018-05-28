<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Interfaces;

interface ISO4217Interface
{
    /**
     * Find a currency by alpha or numeric code
     *
     * @param string $code The alpha or numeric code to find the currency for
     *
     * @return \EoneoPay\Currencies\Interfaces\CurrencyInterface
     *
     * @throws \EoneoPay\Currencies\Exceptions\InvalidCurrencyCodeException Inherited, if currency is invalid
     */
    public function find(string $code): CurrencyInterface;

    /**
     * Return all supported currencies alpha codes.
     *
     * @return string[]
     */
    public function getSupportedAlphaCodes(): array;
}
