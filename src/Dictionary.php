<?php

declare(strict_types=1);

namespace Marussia\i18n;

use Marussia\i18n\Contracts\DictionaryProviderInterface;

class Dictionary
{
    private $dictionaryProvider;

    private $resource;

    private $locale;

    public function __construct(DictionaryProviderInterface $dictionaryProvider, string $resourceFile, string $locale)
    {
        $this->dictionaryProvider = $dictionaryProvider;
        $this->resource = $resourceFile;
        $this->locale = $locale;
    }

    public function translate(string $string, array $placeholders = []) : Translation
    {
        $dictionary = $this->dictionaryProvider->load($this->resource, $this->locale);

        $translation = new Translation($this->resource, $this->locale);

        if (array_key_exists($string, $dictionary) === false) {
            $translation->string = $string;
            return $translation;
        }

        if (is_string($dictionary[$string]) === false) {
            throw new InvalidTranslationValueTypeException(gettype($dictionary[$this->string]));
        }

        if (count($placeholders) === 0) {
            $translation->string = $dictionary[$string];
            return $translation;
        }

        $translation->string = $this->collectTranslation($dictionary, $placeholders);

        return $translation;
    }

    private function collectTranslation(string $translatingString, array $placeholders) : string
    {
        foreach ($placeholders as $placeholder => $value) {
            if (preg_match('(%%' . $placeholder . '%%)', $translatingString) === false) {
                throw new PlaceholderForStringNotFoundException($placeholder);
            }

            $translatingString = preg_replace('(%%' . $placeholder . '%%)', $value, $translatingString);
        }

        return $translatingString;
    }
}
