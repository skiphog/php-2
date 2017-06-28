<?php

namespace App\Exceptions;

use App\Traits\IteratorAggregate;

class MultiException extends \Exception implements \IteratorAggregate
{
    use IteratorAggregate;

    public function add(\Throwable $e)
    {
        $this->data[] = $e;

        return $this;
    }

    /**
     * @return \Exception[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    public function isEmpty(): bool
    {
        return empty($this->data);
    }

    public function toArray(): array
    {
        return array_map(function ($value) {
            /** @var self $value */
            return $value->getMessage();
        }, $this->data);
    }
}
