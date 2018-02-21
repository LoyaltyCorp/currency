<?php
declare(strict_types=1);

namespace EoneoPay\Currency\Interfaces;

interface ISO4217Interface
{
    /**
     * Find a currency by alpha or numeric code
     *
     * @param string $code The alpha or numeric code to find the currency for
     *
     * @return \EoneoPay\Currency\Interfaces\CurrencyInterface
     *
     * @throws \EoneoPay\Currency\Exceptions\InvalidCurrencyCodeException Inherited, if currency is invalid
     */
    public function find(string $code): CurrencyInterface;

    /**
     * Return all supported currencies alpha codes.
     *
     * @return array
     */
//    public function getSupportedAlphaCodes(): array;
}
