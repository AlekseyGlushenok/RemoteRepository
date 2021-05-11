<?php

namespace RemoteRepository\Test\TestClasses;

use RemoteRepository\Extractor\Extractor;

class testExtractor extends Extractor
{
    public function process($data)
    {
        return $data;
    }
}
