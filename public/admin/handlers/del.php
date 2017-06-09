<?php
require __DIR__ . '/../../../autoload.php';

use App\Models\Article;

if (isset($_GET['del'])) {
    $article = Article::findById((int)$_GET['del']);

    if (!$article) {
        http_response_code(500);
        die;
    }

    $article->delete();
    header('Location: /admin');
}
