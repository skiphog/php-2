<?php /** @var $articles Article[] */ ?>
<h1>Все новости</h1>
<?php if (!empty($articles)) : ?>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <a href="/article.php?id=<?php echo $article->id; ?>"><?php echo $article->title; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
