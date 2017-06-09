<?php
use App\Models\Article;

require __DIR__ . '/../autoload.php';

$articles = Article::findAllLatest(3);

include __DIR__ . '/../template/news.php';
