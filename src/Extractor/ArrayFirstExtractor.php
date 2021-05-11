<?php

namespace RemoteRepository\Extractor;

use RemoteRepository\Extractor\Exception\ExtractorException;

class ArrayFirstExtractor extends Extractor
{
    protected function process($data)
    {
        if (is_array($data) && !empty($data)) {
            return reset($data);
        }

        throw new ExtractorException("Data should be not empty array");
    }
}
