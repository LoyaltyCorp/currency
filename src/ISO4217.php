<?php
declare(strict_types=1);

namespace EoneoPay\Currencies;

use EoneoPay\Currencies\Currencies\Aud;
use EoneoPay\Currencies\Currencies\Jpy;
use EoneoPay\Currencies\Currencies\Xbt;
use EoneoPay\Currencies\Exceptions\InvalidCurrencyCodeException;
use EoneoPay\Currencies\Interfaces\CurrencyInterface;
use EoneoPay\Currencies\Interfaces\ISO4217Interface;

class ISO4217 implements ISO4217Interface
{
    /** @var string[] */
    private static $currenciesAlpha = [
        'aud' => Aud::class,
        'jpy' => Jpy::class,
        'xbt' => Xbt::class
    ];

    /** @var string[] */
    private static $currenciesNum = [
        '036' => Aud::class,
        '392' => Jpy::class,
        '-' => Xbt::class
    ];

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

        foreach (static::$currenciesAlpha as $currency) {
            $alphaCodes[] = (new $currency)->getAlphaCode();
        }

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
        if ($method === 'getNumericCode' && isset(static::$currenciesNum[$code])) {
            $currency = static::$currenciesNum[$code];

            return new $currency();
        }

        $code = \mb_strtolower($code);

        if ($method === 'getAlphaCode' && isset(static::$currenciesAlpha[$code])) {
            $currency = static::$currenciesAlpha[$code];

            return new $currency();
        }

        // Currency isn't found, throw exception
        throw new InvalidCurrencyCodeException(\sprintf('Currency code can not be found: %s', \mb_strtoupper($code)));
    }
}
