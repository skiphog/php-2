<?php
use App\Models\Article;

require __DIR__ . '/../autoload.php';

if (empty($_GET['id'])) {
    http_response_code(404);
    die();
}

$article = Article::findById((int)$_GET['id']);

if (empty($article)) {
    http_response_code(404);
    die();
}

include __DIR__ . '/../template/article.php';
