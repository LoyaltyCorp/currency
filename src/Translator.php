<?php
declare(strict_types=1);

namespace EoneoPay\Currency;

use EoneoPay\Currency\Exceptions\InvalidLocaleIdentifierException;
use EoneoPay\Currency\Interfaces\LocaleInterface;
use EoneoPay\Currency\Interfaces\TranslatorInterface;

class Translator extends Iterator implements TranslatorInterface
{
    /**
     * Get a list of all locales available in the system
     *
     * @param string $identifier The locale identifier to find
     *
     * @return \EoneoPay\Currency\Interfaces\LocaleInterface
     *
     * @throws \EoneoPay\Currency\Exceptions\InvalidLocaleIdentifierException If locale is invalid
     */
    public function find(string $identifier): LocaleInterface
    {
        // Format identifier
        $identifier = \sprintf(
            '%s_%s',
            \substr(\preg_replace('/[^a-zA-Z]+/', '', $identifier), 0, 2),
            \substr(\preg_replace('/[^a-zA-Z]+/', '', $identifier), -2)
        );

        $locale = $this->iterateDirectory(function (LocaleInterface $locale) use ($identifier) {
            // Check currency against code
            if (\mb_strtolower($locale->getIdentifier()) === \mb_strtolower($identifier)) {
                return $locale;
            }

            return null;
        }, 'Locales', LocaleInterface::class);

        if (null !== $locale) {
            return $locale;
        }

        // Locale isn't found, throw exception
        throw new InvalidLocaleIdentifierException(
            \sprintf('Locale identifier can not be found: %s', \mb_strtoupper($identifier))
        );
    }

    /**
     * Return all supported supported locales
     *
     * @return array
     */
    public function getSupportedLocales(): array
    {
        $localeCodes = [];

        $this->iterateDirectory(function (LocaleInterface $locale) use (&$localeCodes) {
            $localeCodes[] = $locale->getIdentifier();
        }, 'Locales', LocaleInterface::class);

        return $localeCodes;
    }
}
