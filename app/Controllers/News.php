<?php

namespace App\Controllers;

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
        $article = Article::findById($_GET['id'] ?? null);
        if (false === $article) {
            http_response_code(404);
            die;
        }
        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../../template/article.php');
    }
}
