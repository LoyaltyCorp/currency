<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currency;

use EoneoPay\Currency\Interfaces\LocaleInterface;
use PHPUnit\Framework\TestCase;
use Tests\EoneoPay\Currency\Stubs\CurrencyStub;
use Tests\EoneoPay\Currency\Stubs\LocaleStub;
use Tests\EoneoPay\Currency\Stubs\LocaleTranslatableStub;

/**
 * @covers \EoneoPay\Currency\Locale
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
        self::assertSame('𝔰12,345.6789000000', $locale->formatCurrency(12345.67890, new CurrencyStub()));
        self::assertSame('12,345.6789000000', $locale->formatNumeric(12345.67890, new CurrencyStub()));
        self::assertSame('-𝔰12,345.6789000000', $locale->formatCurrency(-12345.67890, new CurrencyStub()));
        self::assertSame('- 12,345.6789000000', $locale->formatNumeric(-12345.67890, new CurrencyStub()));
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
        self::assertSame('!@:#$%?^&*()))))) 𝔰', $locale->formatCurrency(12345.67890, new CurrencyStub()));
        self::assertSame('!@:#$%?^&*())))))', $locale->formatNumeric(12345.67890, new CurrencyStub()));
        self::assertSame('!@:#$%?^&*()))))) 𝔰|', $locale->formatCurrency(-12345.67890, new CurrencyStub()));
        self::assertSame('!@:#$%?^&*()))))) ||', $locale->formatNumeric(-12345.67890, new CurrencyStub()));
    }
}
