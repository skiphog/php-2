<?php
require __DIR__ . '/../../autoload.php';

use App\View;
use App\Models\Author;
use App\Models\Article;

$article = Article::findById((int)$_GET['edit']);

if (empty($article)) {
    http_response_code(404);
    die;
}

$view = new View();
/** @noinspection PhpUndefinedFieldInspection */
$view->authors = Author::findAll();
/** @noinspection PhpUndefinedFieldInspection */
$view->article = $article;
$view->display(__DIR__ . '/../../template/admin/edit.php');
