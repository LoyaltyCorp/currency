<?php
declare(strict_types=1);

namespace EoneoPay\Currencies;

use EoneoPay\Currencies\Interfaces\FormatterInterface;

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
     * @var \EoneoPay\Currencies\Interfaces\CurrencyInterface
     */
    private $currency;

    /**
     * Create a new formatter instance
     *
     * @param string $amount The amount to format
     * @param string $currency The currency being used
     *
     * @throws \EoneoPay\Currencies\Exceptions\InvalidCurrencyCodeException Inherited, if currency is invalid
     */
    public function __construct(string $amount, string $currency)
    {
        // Remove all non-numeric values from amount and convert to float
        $this->amount = (float)\preg_replace('/[^\d\-\.]+/', '', $amount);

        // Attempt to find the currency class
        $this->currency = (new ISO4217())->find($currency);
    }

    /**
     * @inheritdoc
     */
    public function currency(string $locale): string
    {
        return (new Translator())->find($locale)->formatCurrency($this->amount, $this->currency);
    }

    /**
     * @inheritdoc
     */
    public function decimal(): string
    {
        return \sprintf(\sprintf('%%0.%df', $this->currency->getMinorUnit()), (string)$this->amount);
    }

    /**
     * @inheritdoc
     */
    public function numeric(string $locale): string
    {
        return (new Translator())->find($locale)->formatNumeric($this->amount, $this->currency);
    }
}
