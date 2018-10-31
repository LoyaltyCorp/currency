<?php
declare(strict_types=1);

namespace EoneoPay\Currencies\Interfaces\Locales;

interface TranslatableInterface
{
    /**
     * Get translation mapping for demical -> locale numbers
     *
     * @return string[]
     */
    public function getTranslationMapping(): array;
}
