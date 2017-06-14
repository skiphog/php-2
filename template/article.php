<?php /** @var \App\Models\Article $article */ ?>
<article>
    <h1><?php echo $article->title; ?></h1>
    <p><?php echo $article->text; ?></p>
    <p>
        <?php echo !empty($article->author) ? $article->author->name : 'Нет автора'; ?>
    </p>
</article>
