<?php

use App\Models\Article;

return [
    function (Article $article) {
        return $article->title;
    },
    function (Article $article) {
        return (null !== $article->author) ? $article->author->name : 'Нет автора';
    },


];
