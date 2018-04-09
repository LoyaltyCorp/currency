<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currency;

use EoneoPay\Currency\Locales\EnAu;
use EoneoPay\Currency\Exceptions\InvalidLocaleIdentifierException;
use EoneoPay\Currency\Translator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \EoneoPay\Currency\Iterator
 * @covers \EoneoPay\Currency\Translator
 */
class TranslatorTest extends TestCase
{
    /**
     * Find currency by alpha or numeric code
     *
     * @return void
     */
    public function testFindCurrencyByCode(): void
    {
        $translator = new Translator();

        // Ensure not case sensitive and can be found as long as identifier is valid
        /** @noinspection UnnecessaryAssertionInspection Return type denotes CurrencyInterface, not AUD explcitly */
        self::assertInstanceOf(EnAu::class, $translator->find('en_AU'));
        /** @noinspection UnnecessaryAssertionInspection Return type denotes CurrencyInterface, not AUD explcitly */
        self::assertInstanceOf(EnAu::class, $translator->find('en_au'));
        /** @noinspection UnnecessaryAssertionInspection Return type denotes CurrencyInterface, not AUD explcitly */
        self::assertInstanceOf(EnAu::class, $translator->find('en-au'));
        /** @noinspection UnnecessaryAssertionInspection Return type denotes CurrencyInterface, not AUD explcitly */
        self::assertInstanceOf(EnAu::class, $translator->find('enau'));
    }

    /**
     * Test finding an invalid locale
     *
     * @return void
     */
    public function testFindInvalidLocaleIdentifier(): void
    {
        $this->expectException(InvalidLocaleIdentifierException::class);

        (new Translator())->find('INVALID');
    }

    /**
     * Test supported locales returns an array containing a known type
     *
     * @return void
     */
    public function testGetSupportedAlphaCodes(): void
    {
        self::assertContains('en_AU', (new Translator())->getSupportedLocales());
    }
}
