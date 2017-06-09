<?php

namespace App;

/**
 * @method static Config getInstance()
 */
class Config
{
    use Singleton;

    public $data;

    private function __construct()
    {
        $this->data = require __DIR__ . '/../config.php';
    }
}
