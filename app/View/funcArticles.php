<?php

use App\Models\Article;

return [
    function (Article $article) {
        return $article->title;
    },
    function (Article $article) {
        return (null !== $article->author) ? $article->author->name : 'Нет автора';
    },
    function (Article $article) {
        $view = new \App\View();
        $view->article = $article;
        return $view->render(__DIR__ . '/../../template/admin/particles/buttons.php');
    }
];
