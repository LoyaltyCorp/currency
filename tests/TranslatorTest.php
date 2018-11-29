<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currencies;

use EoneoPay\Currencies\Exceptions\InvalidLocaleIdentifierException;
use EoneoPay\Currencies\Locales\EnAu;
use EoneoPay\Currencies\Translator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \EoneoPay\Currencies\Iterator
 * @covers \EoneoPay\Currencies\Translator
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
        self::assertInstanceOf(EnAu::class, $translator->find('en_AU'));
        self::assertInstanceOf(EnAu::class, $translator->find('en_au'));
        self::assertInstanceOf(EnAu::class, $translator->find('en-au'));
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
        self::assertContains('en-AU', (new Translator())->getSupportedLocales());
    }
}
