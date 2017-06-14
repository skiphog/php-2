<?php
use App\View;
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

$view = new View();
/** @noinspection PhpUndefinedFieldInspection */
$view->article = $article;
$view->display(__DIR__ . '/../template/article.php');
