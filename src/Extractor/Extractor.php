<?php

namespace RemoteRepository\Extractor;

abstract class Extractor
{
    protected ?self $next;

    public function __construct(?self $next = null)
    {
        $this->next = $next;
    }

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
