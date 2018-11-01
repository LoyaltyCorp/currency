<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Locales;

use EoneoPay\Currencies\Locale;

class FrFr extends Locale
{
    /**
     * @inheritdoc
     */
    public function getIdentifier(): string
    {
        return 'fr-FR';
    }

    /**
     * @inheritdoc
     */
    protected function getCurrencyFormat(): string
    {
        return "-# \u{A4}";
    }

    /**
     * @inheritdoc
     */
    protected function getDecimalSeparator(): string
    {
        return ',';
    }

    /**
     * @inheritdoc
     */
    protected function getNegativeSymbol(): string
    {
        return '-';
    }

    /**
     * @inheritdoc
     */
    protected function getNumericFormat(): string
    {
        return '-#';
    }

    /**
     * @inheritdoc
     */
    protected function getThousandsSeparator(): string
    {
        return ' ';
    }
}
