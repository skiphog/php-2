<?php

namespace App\Controllers;

class Error extends Controller
{
    protected function action404()
    {
        http_response_code(404);
        $this->view->display(__DIR__ . '/../../template/errors/404.php');
    }

    protected function action500()
    {
        http_response_code(500);
        $this->view->display(__DIR__ . '/../../template/errors/500.php');
    }

    protected function action503()
    {
        http_response_code(503);
        $this->view->display(__DIR__ . '/../../template/errors/500.php');
    }
}
