<?php
require __DIR__ . '/../app/Models/Article.php';

if (empty($_GET['id'])) {
    http_response_code(404);
    die();
}

if (!$article = Article::findById((int)$_GET['id'])) {
    http_response_code(404);
    die();
}

include __DIR__ . '/../template/article.php';