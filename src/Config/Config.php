<?php

namespace RemoteRepository\Config;

use RemoteRepository\Extractor\Contracts\Extractor;

class Config
{
    public function getEndpoint(string $action)
    {
    }

    public function getExtractor(string $action): Extractor
    {
    }

    public function getFields(): array
    {
    }
}
