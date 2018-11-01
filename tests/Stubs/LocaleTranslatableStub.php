<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currencies\Stubs;

use EoneoPay\Currencies\Interfaces\Locales\TranslatableInterface;
use EoneoPay\Currencies\Locale;

class LocaleTranslatableStub extends Locale implements TranslatableInterface
{
    /**
     * @inheritdoc
     */
    public function getIdentifier(): string
    {
        return 'te_TR';
    }

    /**
     * @inheritdoc
     */
    public function getTranslationMapping(): array
    {
        return [
            0 => ')',
            1 => '!',
            2 => '@',
            3 => '#',
            4 => '$',
            5 => '%',
            6 => '^',
            7 => '&',
            8 => '*',
            9 => '('
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getCurrencyFormat(): string
    {
        return "# \u{A4}-";
    }

    /**
     * @inheritdoc
     */
    protected function getDecimalSeparator(): string
    {
        return '?';
    }

    /**
     * @inheritdoc
     */
    protected function getNegativeSymbol(): string
    {
        return '|';
    }

    /**
     * @inheritdoc
     */
    protected function getNumericFormat(): string
    {
        return '# --';
    }

    /**
     * @inheritdoc
     */
    protected function getThousandsSeparator(): string
    {
        return ':';
    }
}
