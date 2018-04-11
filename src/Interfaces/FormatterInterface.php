<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Interfaces;

interface FormatterInterface
{
    /**
     * Get currency formatted for display including symbol
     *
     * @param string $locale The locale to display the currency in
     *
     * @return string
     */
    public function currency(string $locale): string;

    /**
     * Get currency formatted as standard decimal value
     *
     * @return string
     */
    public function decimal(): string;

    /**
     * Get currency formatted with only numeric values
     *
     * @param string $locale The locale to display the currency in
     *
     * @return string
     */
    public function numeric(string $locale): string;
}
