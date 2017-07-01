<?php

namespace App\View;

use App\View;

class AdminDataTable
{
    /**
     * Масссив с моделями
     * @var array
     */
    protected $models;

    /**
     * Массив с функциями
     * @var array
     */
    protected $functions;

    public function __construct(array $models, array $functions)
    {
        $this->models = $models;
        $this->functions = $functions;
    }

    public function render(string $template)
    {
        $view = new View();
        $view->assign([
            'models'    => $this->models,
            'functions' => $this->functions
        ]);
        return $view->render($template);
    }
}
