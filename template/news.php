<?php /** @var $articles \App\Models\Article[] */ ?>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<div class="container">
    <h1 class="text-center">Все новости</h1>
    <?php if (!empty($articles)) : ?>
        <div class="list-group">
            <?php foreach ($articles as $article) : ?>
                <a href="//php-2/news/one?id=<?php echo $article->id; ?>"
                        class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo $article->title; ?></h5>
                        <small>
                            <?php echo (null !== $article->author) ? $article->author->name : 'Нет автора'; ?>
                        </small>
                    </div>
                    <p class="mb-1"><?php echo $article->shortcut; ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>