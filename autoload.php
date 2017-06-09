<?php

function __autoload($class)
{
    $path = __DIR__ . '/' . str_replace(['\\', 'App'], ['/', 'app'], $class) . '.php';

    if (is_readable($path)) {
        /** @noinspection PhpIncludeInspection */
        require $path;
    }
}
