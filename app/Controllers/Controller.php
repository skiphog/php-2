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
        $method = 'action' . $action;
        if (!method_exists($this, $method)) {
            http_response_code(500);
            die('Метод не найден');
        }

        if (!$this->assess()) {
            http_response_code(403);
            die('Доступ запрещен');
        }

        $this->$method();
    }

    protected function assess(): bool
    {
        return true;
    }
}
