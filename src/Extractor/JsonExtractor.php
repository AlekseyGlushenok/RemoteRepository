<?php

namespace RemoteRepository\Extractor;

use JsonException;
use RemoteRepository\Extractor\Exception\ExtractorException;

class JsonExtractor extends Extractor
{
    protected function process($data)
    {
        try {
            return json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new ExtractorException("This data can't be translated from json", 500, $e);
        }
    }
}
