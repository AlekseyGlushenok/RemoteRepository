<?php

namespace RemoteRepository\Extractor;

use RemoteRepository\Extractor\Exception\ExtractorException;

class InnerDataExtractor extends Extractor
{
    private string $key;

    public function __construct(string $key, ?Extractor $next = null, bool $nullOnException = true)
    {
        parent::__construct($next, $nullOnException);
        $this->key = $key;
    }

    protected function process($data)
    {
        if (!isset($data[$this->key])) {
            throw new ExtractorException("Data should have not empty field: {$this->key}");
        }

        return $data[$this->key];
    }
}
