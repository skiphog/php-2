<?php

namespace App\Traits;

trait Singleton
{
    private static $instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    /** @noinspection MagicMethodsValidityInspection */
    private function __wakeup()
    {
    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
