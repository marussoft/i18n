<?php

declare(strict_types=1);

namespace Marussia\i18n;

use Marussia\i18n\Contracts\DictionaryProviderInterface;

class DictionaryProvider implements DictionaryProviderInterface
{
    private $translationsDirPath;

    public function __construct(string $translationsDirPath)
    {
        $this->translationsDirPath = $translationsDirPath;
    }


    public function load(string $resource, string $locale) : array
    {
        $filePath = $this->translationsDirPath . str_replace('.', '/', $resource) . '/' . $locale . '.php';

        if (is_file($filePath)) {
            return require($filePath);
        }
        return [];
    }
}
