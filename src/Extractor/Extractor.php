<?php


namespace RemoteRepository\Extractor;

use RemoteRepository\Extractor\Contracts\Extractor as ExtractorInterface;

abstract class Extractor implements ExtractorInterface
{
    protected ExtractorInterface $next;

    final public function extract($data)
    {
        $data = $this->process($data);

        if ($this->next !== null) {
            return $this->next->extract($data);
        }

        return $data;
    }

    abstract function process($data);
}
