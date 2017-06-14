<?php
require __DIR__ . '/../../../autoload.php';

use App\Models\Article;

if (isset($_POST['id'], $_POST['title'], $_POST['text'])) {
    $article = Article::findById((int)$_POST['id']);

    if (!$article) {
        http_response_code(500);
        die;
    }

    $article->title = $_POST['title'];
    $article->text = $_POST['text'];

    if (false === $article->save()) {
        http_response_code(500);
        die;
    }

    header('Location: /admin');
}
