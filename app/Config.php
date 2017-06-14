<?php

namespace App;

use App\Traits\Singleton;

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
