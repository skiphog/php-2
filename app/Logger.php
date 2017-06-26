<?php

namespace App;

use App\Traits\Singleton;

class Logger
{
    use Singleton;

    private $path;

    private function __construct()
    {
        $this->path = Config::getInstance()->data['log']['path'];
    }

    public static function log(...$data): void
    {
        self::getInstance()->write(...$data);
    }

    public function write(...$data): void
    {
        $write = [];

        foreach ($data as $value) {
            $write[] = $value;
        }

        array_unshift($write, '[' . date('Y-m-d H:i:s') . ']');

        file_put_contents($this->path, implode("\n", $write) . "\n\n", FILE_APPEND | LOCK_EX);
    }
}
