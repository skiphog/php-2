<?php /** @var \App\Models\Article $article */ ?>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<div class="container">
    <h1><?php echo $article->title; ?></h1>
    <hr>
    <div class="mb-3"><?php echo nl2br($article->text); ?></div>
    <p>
        <em><?php echo (null !== $article->author) ? $article->author->name : 'Нет автора'; ?></em>
    </p>
    <div class="text-center">
        <a class="btn btn-outline-info" href="//php-2">Назад</a>
    </div>

</div>
