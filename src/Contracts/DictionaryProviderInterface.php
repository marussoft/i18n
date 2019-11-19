<?php

declare(strict_types=1);

namespace Marussia\I18n\Contracts;

interface DictionaryProviderInterface
{
    public function load(string $resource, string $locale) : array;
}
