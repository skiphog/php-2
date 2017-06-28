<?php

namespace App\View;

use App\Config;

class Twig implements ViewInterface
{
    protected $twig;

    public function __construct()
    {
        $config = Config::getInstance()->data['twig'];

        $loader = new \Twig_Loader_Filesystem($config['path']);

        $this->twig = new \Twig_Environment($loader, [
            'cache'       => $config['cache'],
            'auto_reload' => $config['auto_reload'],
            'debug'       => $config['debug']
        ]);
    }

    public function render(array $data, string $template): string
    {
        return $this->twig->render($template, $data);
    }
}
