<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Interfaces;

interface TranslatorInterface
{
    /**
     * Get a list of all locales available in the system
     *
     * @param string $identifier The locale identifier to find
     *
     * @return \EoneoPay\Currencies\Interfaces\LocaleInterface
     */
    public function find(string $identifier): LocaleInterface;

    /**
     * Return all supported supported locales
     *
     * @return string[]
     */
    public function getSupportedLocales(): array;
}
