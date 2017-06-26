<?php

namespace App\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Article;

class News extends Controller
{
    public function actionIndex()
    {
        $this->view->articles = Article::findAllLatest(3);
        $this->view->display(__DIR__ . '/../../template/news.php');
    }

    public function actionOne()
    {
        if (!$article = Article::findById($this->request->get('id'))) {
            throw new NotFoundException('Новость не найдена');
        }

        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../../template/article.php');
    }
}
