<?php
declare(strict_types=1);

namespace Tests\EoneoPay\Currencies;

use EoneoPay\Currencies\Formatter;
use EoneoPay\Currencies\ISO4217;
use PHPUnit\Framework\TestCase;
use Tests\EoneoPay\Currencies\Stubs\ISO4217Stub;

/**
 * These tests convert a currency for display to:
 *  - ar_OM, Oman, three minor units, leading symbol, arabic thousands, arabic minor, right to left
 *  - zh_CN, China, two minor units, leading symbol, no thousands, period minor, leading negative
 *  - en_AU, Australia, two minor units, leading symbol, command thousands, comma minor, leading negative
 *  - fr_FR, France, two minor units, trailing symbol, space thousands, comma minor, leading negative
 *  - ja_JP, Japan, no minor units, leading symbol, no thousands, period minor, leading negative
 *  - nl_NL, Netherlands, two minor units, leading symbol, period thousands, comma minor, trailing negative
 *
 * @covers \EoneoPay\Currencies\Formatter
 */
class FormatterTest extends TestCase
{
    /**
     * Make sure the formatter ISO4217 is set to its default.
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        Formatter::setISO4217(new ISO4217());
    }

    /**
     * Test formatting a currency for display purposes with different locale when it has eight minor units
     *
     * @return void
     */
    public function testFormattingCurrencyForDisplayEightMinorUnits(): void
    {
        // Format Bitcoin, ensure all locales return eight minor units, rounded decimal value
        $formatter = new Formatter('12345.012345686', 'XBT');
        self::assertSame(
            "\u{661}\u{662}\u{66C}\u{663}\u{664}\u{665}\u{66B}\u{660}\u{661}\u{662}\u{663}\u{664}\u{665}\u{666}" .
            "\u{669} \u{e3f}",
            $formatter->currency('ar_OM')
        );
        self::assertSame("\u{e3f} 12345.01234569", $formatter->currency('zh_CN'));
        self::assertSame("\u{e3f}12,345.01234569", $formatter->currency('en_AU'));
        self::assertSame("12 345,01234569 \u{e3f}", $formatter->currency('fr_FR'));
        self::assertSame("\u{e3f} 12345.01234569", $formatter->currency('ja_JP'));
        self::assertSame("\u{e3f} 12.345,01234569", $formatter->currency('nl_NL'));
    }

    /**
     * Test formatting a currency for display purposes with different locale when it has no minor units
     *
     * @return void
     */
    public function testFormattingCurrencyForDisplayNoMinorUnits(): void
    {
        // Format Japanese Yen, ensure all locales return no minor units
        $formatter = new Formatter('12345.062', 'JPY');
        self::assertSame("\u{661}\u{662}\u{66C}\u{663}\u{664}\u{665} \u{a5}", $formatter->currency('ar_OM'));
        self::assertSame("\u{a5} 12345", $formatter->currency('zh_CN'));
        self::assertSame("\u{a5}12,345", $formatter->currency('en_AU'));
        self::assertSame("12 345 \u{a5}", $formatter->currency('fr_FR'));
        self::assertSame("\u{a5} 12345", $formatter->currency('ja_JP'));
        self::assertSame("\u{a5} 12.345", $formatter->currency('nl_NL'));
    }

    /**
     * Test formatting a currency for display purposes with different locale when it has two minor units
     *
     * @return void
     */
    public function testFormattingCurrencyForDisplayTwoMinorUnits(): void
    {
        // Format Australian Dollar, ensure all locales return two minor units, rounded decimal value
        $formatter = new Formatter('12345.0686', 'AUD');
        self::assertSame(
            "\u{661}\u{662}\u{66C}\u{663}\u{664}\u{665}\u{66B}\u{660}\u{667} \u{24}",
            $formatter->currency('ar_OM')
        );
        self::assertSame("\u{24} 12345.07", $formatter->currency('zh_CN'));
        self::assertSame("\u{24}12,345.07", $formatter->currency('en_AU'));
        self::assertSame("12 345,07 \u{24}", $formatter->currency('fr_FR'));
        self::assertSame("\u{24} 12345.07", $formatter->currency('ja_JP'));
        self::assertSame("\u{24} 12.345,07", $formatter->currency('nl_NL'));
    }

    /**
     * Test formatting a currency numerically with different locale when it has eight minor units
     *
     * @return void
     */
    public function testFormattingCurrencyNumericallyEightMinorUnits(): void
    {
        // Format Bitcoin, ensure all locales return eight minor units, rounded decimal value
        $formatter = new Formatter('12345.012345686', 'XBT');
        self::assertSame(
            "\u{661}\u{662}\u{66C}\u{663}\u{664}\u{665}\u{66B}\u{660}\u{661}\u{662}\u{663}\u{664}\u{665}\u{666}\u{669}",
            $formatter->numeric('ar_OM')
        );
        self::assertSame('12345.01234569', $formatter->numeric('zh_CN'));
        self::assertSame('12,345.01234569', $formatter->numeric('en_AU'));
        self::assertSame('12 345,01234569', $formatter->numeric('fr_FR'));
        self::assertSame('12345.01234569', $formatter->numeric('ja_JP'));
        self::assertSame('12.345,01234569', $formatter->numeric('nl_NL'));
    }

    /**
     * Test formatting a currency numerically with different locale when it has no minor units
     *
     * @return void
     */
    public function testFormattingCurrencyNumericallyNoMinorUnits(): void
    {
        // Format Japanese Yen, ensure all locales return no minor units
        $formatter = new Formatter('12345.062', 'JPY');
        self::assertSame("\u{661}\u{662}\u{66C}\u{663}\u{664}\u{665}", $formatter->numeric('ar_OM'));
        self::assertSame('12345', $formatter->numeric('zh_CN'));
        self::assertSame('12,345', $formatter->numeric('en_AU'));
        self::assertSame('12 345', $formatter->numeric('fr_FR'));
        self::assertSame('12345', $formatter->numeric('ja_JP'));
        self::assertSame('12.345', $formatter->numeric('nl_NL'));
    }

    /**
     * Test formatting a currency numerically with different locale when it has two minor units
     *
     * @return void
     */
    public function testFormattingCurrencyNumericallyTwoMinorUnits(): void
    {
        // Format Australian Dollar, ensure all locales return two minor units, rounded decimal value
        $formatter = new Formatter('12345.0686', 'AUD');
        self::assertSame(
            "\u{661}\u{662}\u{66C}\u{663}\u{664}\u{665}\u{66B}\u{660}\u{667}",
            $formatter->numeric('ar_OM')
        );
        self::assertSame('12345.07', $formatter->numeric('zh_CN'));
        self::assertSame('12,345.07', $formatter->numeric('en_AU'));
        self::assertSame('12 345,07', $formatter->numeric('fr_FR'));
        self::assertSame('12345.07', $formatter->numeric('ja_JP'));
        self::assertSame('12.345,07', $formatter->numeric('nl_NL'));
    }

    /**
     * Test formatting a currency for display purposes with different locale when it has two minor units and is negative
     *
     * @return void
     */
    public function testFormattingNegativeCurrencyForDisplayTwoMinorUnits(): void
    {
        // Format Australian Dollar, ensure all locales return two minor units, rounded decimal value
        $formatter = new Formatter('-12345.0686', 'AUD');
        self::assertSame(
            "\u{61c}-\u{661}\u{662}\u{66C}\u{663}\u{664}\u{665}\u{66B}\u{660}\u{667} \u{24}",
            $formatter->currency('ar_OM')
        );
        self::assertSame("-\u{24} 12345.07", $formatter->currency('zh_CN'));
        self::assertSame("-\u{24}12,345.07", $formatter->currency('en_AU'));
        self::assertSame("-12 345,07 \u{24}", $formatter->currency('fr_FR'));
        self::assertSame("-\u{24} 12345.07", $formatter->currency('ja_JP'));
        self::assertSame("\u{24} -12.345,07", $formatter->currency('nl_NL'));
    }

    /**
     * Test formatting a currency numerically with different locale when it has two minor units and is a negative value
     *
     * @return void
     */
    public function testFormattingNegativeCurrencyNumericallyTwoMinorUnits(): void
    {
        // Format Australian Dollar, ensure all locales return two minor units, rounded decimal value
        $formatter = new Formatter('-12345.0686', 'AUD');
        self::assertSame(
            "\u{61c}-\u{661}\u{662}\u{66C}\u{663}\u{664}\u{665}\u{66B}\u{660}\u{667}",
            $formatter->numeric('ar_OM')
        );
        self::assertSame('-12345.07', $formatter->numeric('zh_CN'));
        self::assertSame('-12,345.07', $formatter->numeric('en_AU'));
        self::assertSame('-12 345,07', $formatter->numeric('fr_FR'));
        self::assertSame('-12345.07', $formatter->numeric('ja_JP'));
        self::assertSame('-12.345,07', $formatter->numeric('nl_NL'));
    }

    /**
     * Test getting various values as a decimal value
     *
     * @return void
     */
    public function testGettingCurrencyAsDecimalWithVariousMinorUnits(): void
    {
        self::assertSame('12345', (new Formatter('12345.062', 'JPY'))->decimal());
        self::assertSame('12345.07', (new Formatter('12345.0686', 'AUD'))->decimal());
        self::assertSame('12345.01234569', (new Formatter('12345.012345686', 'XBT'))->decimal());

        self::assertSame('-12345.07', (new Formatter('-12345.0686', 'AUD'))->decimal());
    }

    /**
     * Test overriding ISO4217
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     *
     * @return void
     */
    public function testOverrideISO4217(): void
    {
        Formatter::setISO4217(new ISO4217Stub());

        self::assertSame('12345.06', (new Formatter('12345.062', 'USD'))->decimal());
        self::assertSame('12345.07', (new Formatter('12345.0686', 'USD'))->decimal());
        self::assertSame('12345.01', (new Formatter('12345.01', 'USD'))->decimal());

        self::assertSame('-12345.07', (new Formatter('-12345.0686', 'USD'))->decimal());
    }
}
