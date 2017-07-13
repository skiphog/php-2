<?php

namespace App\Controllers;

use App\View;
use App\Request;
use App\Component\Auth;
use App\Exceptions\ForbiddenException;

abstract class Controller
{
    /**
     * @var View
     */
    protected $view;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Auth
     */
    protected $auth;

    public function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
        $this->auth = new Auth();
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
