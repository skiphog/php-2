<?php /** @var $articles \App\Models\Article[] */ ?>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<div class="container">
    <h1 class="text-center">Управление новостями</h1>
    <?php if (!empty($articles)) : ?>
        <div class="list-group mb-3">
            <?php foreach ($articles as $article) : ?>
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo $article->title; ?></h5>
                        <small>
                            <?php echo (null !== $article->author) ? $article->author->name : 'Нет автора'; ?>
                        </small>
                    </div>
                    <p class="mb-1"><?php echo $article->shortcut; ?></p>
                    <div>
                        <a href="//php-2/admin/news/edit?id=<?php echo $article->id; ?>"
                                class="btn btn-outline-primary btn-sm">
                            Редактировать
                        </a>
                        <a href="//php-2/admin/news/delete?id=<?php echo $article->id; ?>"
                                class="btn btn-outline-danger btn-sm" onclick="return false">
                            Удалить
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="text-center mb-5">
        <a href="//php-2/admin/news/create" class="btn btn-outline-success">Добавить новость</a>
    </div>
</div>