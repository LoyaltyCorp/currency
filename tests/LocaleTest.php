<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currencies;

use EoneoPay\Currencies\Interfaces\LocaleInterface;
use PHPUnit\Framework\TestCase;
use Tests\EoneoPay\Currencies\Stubs\CurrencyStub0;
use Tests\EoneoPay\Currencies\Stubs\LocaleStub;
use Tests\EoneoPay\Currencies\Stubs\LocaleTranslatableStub;

/**
 * @covers \EoneoPay\Currencies\Locale
 */
class LocaleTest extends TestCase
{
    /**
     * Invoke a locale and test standard functionality
     *
     * @return void
     */
    public function testLocaleStandardFunctionality(): void
    {
        $locale = new LocaleStub();

        self::assertInstanceOf(LocaleInterface::class, $locale);
        self::assertSame('te_ST', $locale->getIdentifier());
        self::assertSame('𝔰12,345.6789000000', $locale->formatCurrency(12345.67890, new CurrencyStub0()));
        self::assertSame('12,345.6789000000', $locale->formatNumeric(12345.67890, new CurrencyStub0()));
        self::assertSame('-𝔰12,345.6789000000', $locale->formatCurrency(-12345.67890, new CurrencyStub0()));
        self::assertSame('- 12,345.6789000000', $locale->formatNumeric(-12345.67890, new CurrencyStub0()));
    }

    /**
     * Invoke a locale and test translation functionality
     *
     * @return void
     */
    public function testLocaleTranslationFunctionality(): void
    {
        $locale = new LocaleTranslatableStub();

        self::assertInstanceOf(LocaleInterface::class, $locale);
        self::assertSame('te_TR', $locale->getIdentifier());
        self::assertSame('!@:#$%?^&*()))))) 𝔰', $locale->formatCurrency(12345.67890, new CurrencyStub0()));
        self::assertSame('!@:#$%?^&*())))))', $locale->formatNumeric(12345.67890, new CurrencyStub0()));
        self::assertSame('!@:#$%?^&*()))))) 𝔰|', $locale->formatCurrency(-12345.67890, new CurrencyStub0()));
        self::assertSame('!@:#$%?^&*()))))) ||', $locale->formatNumeric(-12345.67890, new CurrencyStub0()));
    }
}
