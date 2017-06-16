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
        $this->checkMethod($method);
        $this->checkAccess();

        $this->$method();
    }

    protected function assess(): bool
    {
        return true;
    }

    private function checkMethod(string $method): void
    {
        if (!method_exists($this, $method)) {
            http_response_code(500);
            die('Метод не найден');
        }
    }

    private function checkAccess(): void
    {
        if (false === $this->assess()) {
            http_response_code(403);
            die('Доступ запрещен');
        }
    }
}
