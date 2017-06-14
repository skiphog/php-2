<?php
require __DIR__ . '/../../../autoload.php';

use App\Models\Article;

if (isset($_POST['title'], $_POST['text'])) {
    $article = new Article();

    $article->title = $_POST['title'];
    $article->text = $_POST['text'];
    $article->author_id = $_POST['author_id'] ?? null;

    if (!$article->save()) {
        http_response_code(500);
        die;
    }

    header('Location: /admin');
}
