<?php

declare(strict_types=1);

namespace Marussia\i18n;

use Marussia\i18n\Contracts\DictionaryProviderInterface;

class Translator
{
    private $dictionaryProvider;

    public function __construct(DictionaryProvider $dictionaryProvider)
    {
        $this->dictionaryProvider = $dictionaryProvider;
    }

    public function dict(string $resourceFile, string $locale) : Dictionary
    {
        return new Dictionary($this->dictionaryProvider, $resourceFile, $locale);
    }

    public function setProvider(DictionaryProviderInterface $dictionaryProvider)
    {
        $this->dictionaryProvider = $dictionaryProvider;
    }
}
