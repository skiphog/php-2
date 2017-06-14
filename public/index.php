<?php
use App\View;
use App\Models\Article;

require __DIR__ . '/../autoload.php';

$view = new View();
/** @noinspection PhpUndefinedFieldInspection */
$view->articles = Article::findAllLatest(3);
$view->display(__DIR__ . '/../template/news.php');
