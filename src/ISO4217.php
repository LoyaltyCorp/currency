<?php
declare(strict_types=1);

namespace EoneoPay\Currencies;

use EoneoPay\Currencies\Exceptions\InvalidCurrencyCodeException;
use EoneoPay\Currencies\Interfaces\CurrencyInterface;
use EoneoPay\Currencies\Interfaces\ISO4217Interface;

class ISO4217 extends Iterator implements ISO4217Interface
{
    /**
     * @inheritdoc
     */
    public function find(string $code): CurrencyInterface
    {
        // If code is numeric, find by numeric code
        return $this->findCurrency($code, \is_numeric($code) ? 'getNumericCode' : 'getAlphaCode');
    }

    /**
     * @inheritdoc
     */
    public function getSupportedAlphaCodes(): array
    {
        $alphaCodes = [];

        $this->iterateDirectory(function (CurrencyInterface $currency) use (&$alphaCodes): void {
            $alphaCodes[] = $currency->getAlphaCode();
        }, 'Currencies', CurrencyInterface::class);

        return $alphaCodes;
    }

    /**
     * Get a list of all currencies available in the system
     *
     * @param string $code The alpha or numeric code to find the currency for
     * @param string $method The comparison method to use
     *
     * @return \EoneoPay\Currencies\Interfaces\CurrencyInterface
     *
     * @throws \EoneoPay\Currencies\Exceptions\InvalidCurrencyCodeException If currency is invalid
     */
    private function findCurrency(string $code, string $method): CurrencyInterface
    {
        $currency = $this->iterateDirectory(
            function (CurrencyInterface $currency) use ($code, $method): ?CurrencyInterface {
                // Check currency against code
                if (\mb_strtolower($currency->{$method}()) === \mb_strtolower($code)) {
                    return $currency;
                }

                return null;
            },
            'Currencies',
            CurrencyInterface::class
        );

        if ($currency !== null) {
            return $currency;
        }

        // Currency isn't found, throw exception
        throw new InvalidCurrencyCodeException(\sprintf('Currency code can not be found: %s', \mb_strtoupper($code)));
    }
}
