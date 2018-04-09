<?php
declare(strict_types=1);

namespace EoneoPay\Currency\Interfaces;

interface LocaleInterface
{
    /**
     * Format a currency to the correct format
     *
     * @param float $value The value to format
     * @param \EoneoPay\Currency\Interfaces\CurrencyInterface $currency The currency used
     *
     * @return string
     */
    public function formatCurrency(float $value, CurrencyInterface $currency): string;

    /**
     * Format a number to the correct format
     *
     * @param float $value The value to format
     * @param \EoneoPay\Currency\Interfaces\CurrencyInterface $currency The currency used
     *
     * @return string
     */
    public function formatNumeric(float $value, CurrencyInterface $currency): string;

    /**
     * Get the identifier for the current locale
     *
     * @return string
     */
    public function getIdentifier(): string;
}
