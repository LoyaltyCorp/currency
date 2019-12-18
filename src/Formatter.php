<?php
declare(strict_types=1);

namespace EoneoPay\Currencies;

use EoneoPay\Currencies\Interfaces\FormatterInterface;
use EoneoPay\Currencies\Interfaces\ISO4217Interface;

class Formatter implements FormatterInterface
{
    /**
     * @var \EoneoPay\Currencies\Interfaces\ISO4217Interface
     */
    private static $iso4217;

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
     * The rounding mode being used
     *
     * @var int|null
     */
    private $roundingMode;

    /**
     * Create a new formatter instance
     *
     * @param string $amount The amount to format
     * @param string $currency The currency being used
     * @param int|null $roundingMode The rounding mode to use
     *
     * @throws \EoneoPay\Currencies\Exceptions\InvalidCurrencyCodeException Inherited, if currency is invalid
     */
    public function __construct(string $amount, string $currency, ?int $roundingMode = null)
    {
        // Remove all non-numeric values from amount and convert to float
        $this->amount = (float)\preg_replace('/[^\d\-\.]+/', '', $amount);

        // Attempt to find the currency class
        $this->currency = $this::getISO4217()->find($currency);

        // Set rounding mode if applicable
        $this->roundingMode = $roundingMode;
    }

    /**
     * Sets the ISO4217 instance used for currency lookup.
     *
     * @param \EoneoPay\Currencies\Interfaces\ISO4217Interface $iso4217
     *
     * @return void
     */
    public static function setISO4217(ISO4217Interface $iso4217): void
    {
        self::$iso4217 = $iso4217;
    }

    /**
     * Returns the ISO4217 for use inside this formatter.
     *
     * @return \EoneoPay\Currencies\Interfaces\ISO4217Interface
     */
    private static function getISO4217(): ISO4217Interface
    {
        if (self::$iso4217 === null) {
            self::$iso4217 = new ISO4217();
        }

        return self::$iso4217;
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
        return \sprintf(
            \sprintf('%%0.%df', $this->currency->getMinorUnit()),
            (string)\round($this->amount, $this->currency->getMinorUnit(), $this->getRoundingMode())
        );
    }

    /**
     * Get rounding mode
     *
     * @return int
     */
    private function getRoundingMode(): int
    {
        return $this->roundingMode ?? \PHP_ROUND_HALF_UP;
    }

    /**
     * @inheritdoc
     */
    public function numeric(string $locale): string
    {
        return (new Translator())->find($locale)->formatNumeric($this->amount, $this->currency);
    }
}
