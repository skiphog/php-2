<?php

namespace App\Controllers;

use App\Models\Article;
use App\Exceptions\NotFoundException;

class News extends Controller
{
    /**
     * Главная страница
     * @throws \App\Exceptions\DataBaseException
     */
    public function actionIndex()
    {
        $this->view->articles = Article::findAll();
        $this->view->display(__DIR__ . '/../../template/news.php');
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
        $this->view->display(__DIR__ . '/../../template/article.php');
    }
}
