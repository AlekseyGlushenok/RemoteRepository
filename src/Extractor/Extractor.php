<?php

namespace RemoteRepository\Extractor;

use RemoteRepository\Extractor\Exception\ExtractorException;

abstract class Extractor
{
    protected ?self $next;

    protected bool $nullOnException;

    public function __construct(?self $next = null, bool $nullOnException = true)
    {
        $this->nullOnException = $nullOnException;
        $this->next = $next;
    }

    /**
     * @throws ExtractorException
     */
    final public function extract($data)
    {
        try {
            $data = $this->process($data);
        } catch (ExtractorException $e) {
            if ($this->nullOnException) {
                return null;
            }

            throw $e;
        }

        if ($this->next !== null) {
            return $this->next->extract($data);
        }

        return $data;
    }

    /**
     * @throws ExtractorException
     */
    abstract protected function process($data);
}
