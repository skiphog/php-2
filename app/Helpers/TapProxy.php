<?php

namespace App\Helpers;

class TapProxy
{
    protected $proxy;

    public function __construct($value)
    {
        $this->proxy = $value;
    }

    public function __call($name, $arguments)
    {
        $this->proxy->{$name}(...$arguments);

        return $this->proxy;
    }
}
