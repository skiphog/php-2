<?php

namespace App\Traits;

/**
 * Попробовал использовать
 * Trait IteratorAggregate
 * @package App\Traits
 */
trait IteratorAggregate
{
    protected $data = [];
    /**
     * @return \ArrayIterator
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->data);
    }
}
