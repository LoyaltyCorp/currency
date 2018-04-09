<?php
declare(strict_types=1);

namespace EoneoPay\Currency;

use EoneoPay\Currency\Interfaces\CurrencyInterface;
use EoneoPay\Currency\Interfaces\LocaleInterface;

abstract class Locale implements LocaleInterface
{
    /**
     * Get translation mapping for replacing integers to another language
     *
     * @var array
     */
    protected $translations = [];

    /**
     * Format a currency to the correct format
     *
     * @param float $value The value to format
     * @param \EoneoPay\Currency\Interfaces\CurrencyInterface $currency The currency used
     *
     * @return string
     */
    public function formatCurrency(float $value, CurrencyInterface $currency): string
    {
        // Format based on whether value is positive or negative
        $formatted = $value < 0 ?
            $this->formatNegativeCurrency($value, $currency) :
            $this->formatPositiveCurrency($value, $currency);

        // Run through translator
        return $this->translate($formatted);
    }

    /**
     * Format a number to the correct format
     *
     * @param float $value The value to format
     * @param \EoneoPay\Currency\Interfaces\CurrencyInterface $currency The currency used
     *
     * @return string
     */
    public function formatNumeric(float $value, CurrencyInterface $currency): string
    {
        // Format based on whether value is positive or negative
        $formatted = $value < 0 ?
            $this->formatNegativeValue($value, $currency) :
            $this->formatPositiveValue($value, $currency);

        // Run through translator
        return $this->translate($formatted);
    }

    /**
     * Translate a formatted value
     *
     * @param string $value The value to translate
     *
     * @return string
     */
    private function translate(string $value): string
    {
        // If there is no translation map or it's invalid, return
        if (!\is_array($this->translations) || !\count($this->translations)) {
            return $value;
        }

        // Translate
        $translated = '';
        foreach (\str_split($value) as $character) {
            // Add to string
            $translated .= $this->translations[$character] ?? $character;
        }

        return $translated;
    }

    /**
     * Get format for currency
     *
     * This uses placeholders for formatting numbers:
     *  - Hyphen/minus (-|\u{2D}) to denote where a negative symbol should go
     *  - Currency sign (¤|\u{A4}) to denote where a currency symbol should go
     *  - Number sign (#|\u{23}) to denote where the formatted number should go
     *
     * @return string
     */
    abstract protected function getCurrencyFormat(): string;

    /**
     * Get decimal separator
     *
     * @return string
     */
    abstract protected function getDecimalSeparator(): string;

    /**
     * Get negative value symbol
     *
     * @return string
     */
    abstract protected function getNegativeSymbol(): string;

    /**
     * Get numeric format
     *
     * This uses placeholders for formatting numbers:
     *  - Hyphen/minus (-|\u{2D}) to denote where a negative symbol should go
     *  - Number sign (#|\u{23}) to denote where the formatted number should go
     *
     * @return string
     */
    abstract protected function getNumericFormat(): string;

    /**
     * Get thousands separator
     *
     * @return string
     */
    abstract protected function getThousandsSeparator(): string;

    /**
     * Format a currency to the correct format
     *
     * @param float $value The value to format
     * @param \EoneoPay\Currency\Interfaces\CurrencyInterface $currency The currency used
     *
     * @return string
     */
    private function formatNegativeCurrency(float $value, CurrencyInterface $currency): string
    {
        // Format positive value
        $formatted = $this->formatPositiveValue(\abs($value), $currency);

        // Return formatted
        return \str_replace(
            ["\u{A4}", '-', '#'],
            [$currency->getCurrencySymbol(), $this->getNegativeSymbol(), $formatted],
            $this->getCurrencyFormat()
        );
    }

    /**
     * Format a currency to the correct format
     *
     * @param float $value The value to format
     * @param \EoneoPay\Currency\Interfaces\CurrencyInterface $currency The currency used
     *
     * @return string
     */
    private function formatPositiveCurrency(float $value, CurrencyInterface $currency): string
    {
        // Return formatted
        return \str_replace(
            ["\u{A4}", '-', '#'],
            [$currency->getCurrencySymbol(), '', $this->formatPositiveValue($value, $currency)],
            $this->getCurrencyFormat()
        );
    }

    /**
     * Format a number with the correct separators
     *
     * @param float $value The value to format
     * @param \EoneoPay\Currency\Interfaces\CurrencyInterface $currency The currency being used
     *
     * @return string
     */
    private function formatNegativeValue(float $value, CurrencyInterface $currency): string
    {
        return \str_replace(
            ['-', '#'],
            [$this->getNegativeSymbol(), $this->formatPositiveValue(\abs($value), $currency)],
            $this->getNumericFormat()
        );
    }

    /**
     * Format a number with the correct separators
     *
     * @param float $value The value to format
     * @param \EoneoPay\Currency\Interfaces\CurrencyInterface $currency The currency being used
     *
     * @return string
     */
    private function formatPositiveValue(float $value, CurrencyInterface $currency): string
    {
        return \number_format(
            $value,
            $currency->getMinorUnit(),
            $this->getDecimalSeparator(),
            $this->getThousandsSeparator()
        );
    }
}
