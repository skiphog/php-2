<?php

namespace App\Controllers\Admin;

use App\Models\Author;
use App\Models\Article;
use App\Controllers\Controller;

class News extends Controller
{
    /**
     * Все новости
     */
    public function actionAll()
    {
        $this->view->assign([
            'authors'  => Author::findAll(),
            'articles' => Article::findAll()
        ]);
        $this->view->display(__DIR__ . '/../../../template/admin/index.php');
    }

    /**
     * Редактировать одну новость
     */
    public function actionEdit()
    {
        $article = Article::findById($_GET['id'] ?? null);
        if (false === $article) {
            http_response_code(404);
            die;
        }
        $this->view->article = $article;
        $this->view->display(__DIR__ . '/../../../template/admin/edit.php');
    }

    /**
     * Добавить новость
     */
    public function actionAdd()
    {
        $article = new Article();
        $article->fill($_POST);

        if (!$article->save()) {
            http_response_code(500);
            die;
        }

        header('Location: /admin/news/all');
    }

    /**
     * Обновить новость
     */
    public function actionUpdate()
    {
        $article = Article::findById((int)$_POST['id']);

        if (!$article) {
            http_response_code(500);
            die;
        }

        $article->fill($_POST);

        if (false === $article->save()) {
            http_response_code(500);
            die;
        }

        header('Location: /admin/news/all');
    }

    /**
     * Удалить новость
     */
    public function actionDelete()
    {
        $article = Article::findById($_GET['id'] ?? null);

        if (!$article) {
            http_response_code(500);
            die;
        }

        $article->delete();
        header('Location: /admin/news/all');
    }
}
