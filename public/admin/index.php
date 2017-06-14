<?php

use App\View;
use App\Models\Author;
use App\Models\Article;

require __DIR__ . '/../../autoload.php';

$view = new View();
/** @noinspection PhpUndefinedFieldInspection */
$view->authors = Author::findAll();
/** @noinspection PhpUndefinedFieldInspection */
$view->articles = Article::findAll();

$view->display(__DIR__ . '/../../template/admin/index.php');
