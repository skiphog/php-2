<?php
use App\Models\Article;

require __DIR__ . '/../autoload.php';

assert(Article::findById(1) instanceof Article);
assert(is_array(Article::findAll()));
assert(is_array(Article::findAllLatest(3)));

$article = new Article();

$article->title = 'title';
$article->text = 'text';
$article->author = 'author';

assert(true === $article->save());
assert(is_int($article->id));
