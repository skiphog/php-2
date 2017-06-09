<?php
require __DIR__ . '/../../../autoload.php';

use App\Models\Article;

if (isset($_POST['id'], $_POST['title'], $_POST['text'], $_POST['author'])) {
    $article = Article::findById((int)$_POST['id']);

    if (!$article) {
        http_response_code(500);
        die;
    }

    $article->title = $_POST['title'];
    $article->text = $_POST['text'];
    $article->author = $_POST['author'];

    if (false === $article->save()) {
        http_response_code(500);
        die;
    }

    header('Location: /admin');
}
