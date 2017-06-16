<?php

namespace App\Traits;

trait ArrayAccess
{
    protected $data = [];

    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        if (null === $offset) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }
}