<?php

declare(strict_types=1);

namespace Marussia\i18n;

class Translation
{
    public $resource;

    public $string;

    public $locale;

    public function __construct(string $resourceFile, string $locale)
    {
        $this->resource = $resourceFile;
        $this->locale = $locale;
    }
}

