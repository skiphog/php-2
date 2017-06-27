<?php

namespace App\Exceptions;

class MultiException extends \Exception
{
    protected $data = [];

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

    public function getAllMessage(): array
    {
        return array_map(function ($value) {
            /** @var self $value */
            return $value->getMessage();
        }, $this->data);
    }
}
