<?php
require __DIR__ . '/../../../autoload.php';

use App\Models\Article;

if (isset($_POST['title'], $_POST['text'], $_POST['author'])) {
    $article = new Article();

    $article->title = $_POST['title'];
    $article->text = $_POST['text'];
    $article->author = $_POST['author'];

    if (false === $article->save()) {
        http_response_code(500);
        die;
    }

    header('Location: /admin');
}
