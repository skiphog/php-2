<?php

namespace App\Component;

use App\User;

class Auth
{
    /**
     * @var User
     */
    protected $user;

    public function __construct()
    {
        $this->init();
    }

    public function check(): bool
    {
        return null !== $this->user;
    }

    public function guest(): bool
    {
        return !$this->check();
    }

    public function isAdmin(): bool
    {
        return $this->check() && $this->user()->isAdmin();
    }

    public function user()
    {
        return $this->user;
    }

    protected function init(): void
    {
        $identificator = Auth::identificator();

        if (!empty($_SESSION[$identificator])) {
            $this->user = User::findById($_SESSION[$identificator]);
        }
    }

    public static function identificator()
    {
        return sprintf('user_%s', md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']));
    }
}
