<?php

namespace RemoteRepository\Extractor\Contracts;

interface Extractor
{
    public function __construct(?Extractor $extractor);
    public function extract($data);
}
