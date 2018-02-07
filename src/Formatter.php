<?php
declare(strict_types=1);

namespace EoneoPay\Currency;

use EoneoPay\Currency\Interfaces\FormatterInterface;
use NumberFormatter;

class Formatter implements FormatterInterface
{
    /**
     * The amount to format
     *
     * @var string
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
        // Remove all non-numeric values from amount
        $this->amount = \preg_replace('/[^\d\-\.]+/', '', $amount);

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
        return \sprintf(\sprintf('%%0.%df', $this->currency->getMinorUnit()), $this->amount);
    }

    /**
     * Get currency formatted for display including symbol
     *
     * @param string $locale The locale to display the currency in
     *
     * @return string
     */
    public function display(string $locale): string
    {
        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);

        // Set precision on pattern
        $formatter->setPattern(
            \preg_replace(
                '/#0(\.0+)?/',
                $this->currency->getMinorUnit() > 0 ?
                    \sprintf('#0.%s', str_repeat('0', $this->currency->getMinorUnit())) : '#0',
                $formatter->getPattern()
            )
        );

        // Force currency symbol
        $formatter->setSymbol(NumberFormatter::CURRENCY_SYMBOL, $this->currency->getCurrencySymbol());

        return $formatter->formatCurrency((float)$this->amount, $this->currency->getAlphaCode());
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
        $formatter = new NumberFormatter($locale, NumberFormatter::DECIMAL);

        // Configure currency display
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $this->currency->getMinorUnit());

        return $formatter->format((float)$this->amount);
    }
}
