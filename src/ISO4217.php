<?php
declare(strict_types=1);

namespace EoneoPay\Currency;

use EoneoPay\Currency\Exceptions\InvalidCurrencyCodeException;
use EoneoPay\Currency\Interfaces\CurrencyInterface;
use EoneoPay\Currency\Interfaces\ISO4217Interface;
use GlobIterator;

class ISO4217 implements ISO4217Interface
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
    public function find(string $code): CurrencyInterface
    {
        // If code is numeric, find by numeric code
        return $this->findCurrency($code, \is_numeric($code) ? 'getNumericCode' : 'getAlphaCode');
    }

    /**
     * Return all supported currencies alpha codes.
     *
     * @return array
     */
    public function getSupportedAlphaCodes(): array
    {
        $alphaCodes = [];

        $this->iterateOverCurrencies(function (CurrencyInterface $currency) use (&$alphaCodes) {
            $alphaCodes[] = $currency->getAlphaCode();
        });

        return $alphaCodes;
    }

    /**
     * Get a list of all currencies available in the system
     *
     * @param string $code The alpha or numeric code to find the currency for
     * @param string $method The comparison method to use
     *
     * @return \EoneoPay\Currency\Interfaces\CurrencyInterface
     *
     * @throws \EoneoPay\Currency\Exceptions\InvalidCurrencyCodeException If currency is invalid
     */
    private function findCurrency(string $code, string $method): CurrencyInterface
    {
        $currency = $this->iterateOverCurrencies(function (CurrencyInterface $currency) use ($code, $method) {
            // Check currency against code
            if (\mb_strtolower($currency->{$method}()) === \mb_strtolower($code)) {
                return $currency;
            }

            return null;
        });

        if (null !== $currency) {
            return $currency;
        }

        // Currency isn't found, throw exception
        throw new InvalidCurrencyCodeException(\sprintf('Currency code can not be found: %s', \mb_strtoupper($code)));
    }

    /**
     * Iterate over currencies and pass them to closure.
     *
     * @param \Closure $closure
     *
     * @return mixed|null
     */
    private function iterateOverCurrencies(\Closure $closure)
    {
        $classes = new GlobIterator(\sprintf('%s/*.php', \sprintf('%s/%s', __DIR__, 'Currencies')));

        /** @var \SplFileInfo $class */
        foreach ($classes as $class) {
            // Get basename for class
            $basename = $class->getBasename('.php');

            // Instantiate class
            $className = \sprintf('%s\\Currencies\\%s', __NAMESPACE__, $basename);
            $currency = new $className;

            // Make sure class implements currency interface
            if (!$currency instanceof CurrencyInterface) {
                // @codeCoverageIgnoreStart
                // This is only here as a fail-safe if a non-currency php file is added to the Currencies directory
                continue;
                // @codeCoverageIgnoreEnd
            }

            $return = $closure($currency);

            // Keep looping until closure return something else than null
            if (null !== $return) {
                return $return;
            }
        }

        return null;
    }
}
