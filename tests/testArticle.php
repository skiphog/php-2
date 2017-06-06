<?php
require __DIR__ . '/../app/Models/Article.php';

assert(Article::findById(1) instanceof Article);
assert(is_array(Article::findAll()));
assert(is_array(Article::findAllLatest(3)));




