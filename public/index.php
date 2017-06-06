<?php
require __DIR__ . '/../app/Models/Article.php';

$articles = Article::findAllLatest(3);

include __DIR__ . '/../template/news.php';
