<?php

namespace App\Traits;

/**
 * Попробовал использовать
 * Trait IteratorAggregate
 * @package App\Traits
 * @property array data
 */
trait IteratorAggregate
{
    /**
     * @return \ArrayIterator
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->data);
    }
}
