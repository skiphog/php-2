<?php
use App\Models\Article;

require __DIR__ . '/../autoload.php';

assert(Article::findById(1) instanceof Article);
assert(is_array(Article::findAll()));
assert(is_array(Article::findAllLatest(3)));
