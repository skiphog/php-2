<?php

namespace App\Traits;

/**
 * Trait Iterator
 * @package App\Traits
 * @property array $data
 */
trait Iterator
{
    public function rewind()
    {
        return reset($this->data);
    }

    public function current()
    {
        return current($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function next()
    {
        return next($this->data);
    }

    public function valid(): bool
    {
        return null !== key($this->data);
    }
}
