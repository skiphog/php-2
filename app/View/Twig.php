<?php

namespace App\View;

use App\Config;

class Twig implements ViewInterface
{
    protected $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(Config::getInstance()->data['twig']['path']);
        $this->twig = new \Twig_Environment($loader, [
            'cache'       => Config::getInstance()->data['twig']['cache'],
            'auto_reload' => true,
        ]);
    }

    public function render(array $data, string $template): string
    {
        return $this->twig->render($template, $data);
    }
}
