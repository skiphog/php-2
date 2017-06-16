<?php

namespace App\Controllers;

use App\View;

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action(string $action): void
    {
        if (!$this->assess()) {
            http_response_code(403);
            die('Доступ запрещен');
        }

        $this->$action();
    }

    protected function assess(): bool
    {
        return true;
    }
}
