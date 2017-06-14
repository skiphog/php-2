<?php
use App\Models\Article;

assert(Article::findById(1) instanceof Article);
assert(is_array(Article::findAll()));
assert(is_array(Article::findAllLatest(3)));

$article = new Article();

$article->title = 'title';
$article->text = 'text';

assert(true === $article->save());
assert(is_int($article->id));
assert(true === $article->delete());

$article = Article::findById(1);
assert(true === $article->save());
assert($article->author instanceof \App\Models\Author);
