<?php

namespace App\Controllers;

use App\Models\Article;
use App\Exceptions\NotFoundException;
use App\View\Twig;

class News extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->view->setPlugin(new Twig());
    }

    /**
     * Главная страница
     * @throws \App\Exceptions\DataBaseException
     */
    public function actionIndex()
    {
        $this->view->articles = Article::findAll();
        $this->view->display('news/news.twig');
    }

    /**
     * Показать одну новость
     * @throws NotFoundException
     * @throws \App\Exceptions\DataBaseException
     */
    public function actionOne()
    {
        if (!$article = Article::findById($this->request->get('id'))) {
            throw new NotFoundException('Новость не найдена');
        }

        $this->view->article = $article;
        $this->view->display('news/article.twig');
    }
}
