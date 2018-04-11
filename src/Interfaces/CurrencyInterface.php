<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Interfaces;

interface CurrencyInterface
{
    /**
     * Get the alphabetic code for this currency
     *
     * @return string
     */
    public function getAlphaCode(): string;

    /**
     * Get the currency symbol for this currency
     *
     * @return string
     */
    public function getCurrencySymbol(): string;

    /**
     * Get the minor unit for this currency
     *
     * @return int
     */
    public function getMinorUnit(): int;

    /**
     * Get the currency name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the numeric code for this currency
     *
     * @return string
     */
    public function getNumericCode(): string;
}
