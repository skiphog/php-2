<?php /** @var $articles \App\Models\Article[] */ ?>
<h1>Все новости</h1>
<?php if (!empty($articles)) : ?>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <a href="/article.php?id=<?php echo $article->id; ?>"><?php echo $article->title; ?></a>
                <p>
                    <?php echo null !== $article->author ? $article->author->name : 'Нет автора'; ?>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
