<?php

namespace App\Controllers;

use App\View;
use App\Exceptions\ForbiddenException;

abstract class Controller
{
    /**
     * @var View $view
     */
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action(string $action, ...$params): void
    {
        $method = 'action' . $action;
        $this->checkMethod($method);
        $this->checkAccess();

        $this->$method(...$params);
    }

    protected function assess(): bool
    {
        return true;
    }

    private function checkMethod(string $method): void
    {
        if (!method_exists($this, $method)) {
            throw new \BadMethodCallException('Метод ' . $method . ' в контроллере ' . static::class . ' не найден');
        }
    }

    private function checkAccess(): void
    {
        if (!$this->assess()) {
            throw new ForbiddenException('Доступ запрещен');
        }
    }
}
