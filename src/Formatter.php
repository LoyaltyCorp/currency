<?php
declare(strict_types=1);

namespace EoneoPay\Currency;

use EoneoPay\Currency\Interfaces\FormatterInterface;

class Formatter implements FormatterInterface
{
    /**
     * The amount to format
     *
     * @var float
     */
    private $amount;

    /**
     * The currency being used
     *
     * @var \EoneoPay\Currency\Interfaces\CurrencyInterface
     */
    private $currency;

    /**
     * Create a new formatter instance
     *
     * @param string $amount The amount to format
     * @param string $currency The currency being used
     *
     * @throws \EoneoPay\Currency\Exceptions\InvalidCurrencyCodeException Inherited, if currency is invalid
     */
    public function __construct(string $amount, string $currency)
    {
        // Remove all non-numeric values from amount and convert to float
        $this->amount = (float)\preg_replace('/[^\d\-\.]+/', '', $amount);

        // Attempt to find the currency class
        $this->currency = (new ISO4217())->find($currency);
    }

    /**
     * Get currency formatted as standard decimal value
     *
     * @return string
     */
    public function decimal(): string
    {
        return \sprintf(\sprintf('%%0.%df', $this->currency->getMinorUnit()), (string)$this->amount);
    }

    /**
     * Get currency formatted for display including symbol
     *
     * @param string $locale The locale to display the currency in
     *
     * @return string
     *
     * @throws \EoneoPay\Currency\Exceptions\InvalidLocaleIdentifierException Inherited, if locale is invalid
     */
    public function display(string $locale): string
    {
        return (new Translator())->find($locale)->formatCurrency($this->amount, $this->currency);
    }

    /**
     * Get currency formatted with only numeric values
     *
     * @param string $locale The locale to display the currency in
     *
     * @return string
     */
    public function numeric(string $locale): string
    {
        return (new Translator())->find($locale)->formatNumeric($this->amount, $this->currency);
    }
}
