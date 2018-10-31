<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currencies\Stubs;

use EoneoPay\Currencies\Locale;

class LocaleStub extends Locale
{
    /**
     * @inheritdoc
     */
    public function getIdentifier(): string
    {
        return 'te_ST';
    }

    /**
     * @inheritdoc
     */
    protected function getCurrencyFormat(): string
    {
        return "-\u{A4}#";
    }

    /**
     * @inheritdoc
     */
    protected function getDecimalSeparator(): string
    {
        return '.';
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
        return '- #';
    }

    /**
     * @inheritdoc
     */
    protected function getThousandsSeparator(): string
    {
        return ',';
    }
}
