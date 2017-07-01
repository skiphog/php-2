<?php /** @var $articles \App\Models\Article[] */ ?>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<div class="container">
    <h1 class="text-center">Админка</h1>
    <?php
    echo (new \App\View\AdminDataTable($articles, require __DIR__ . '/../../app/View/funcArticles.php'))->render();
    ?>
    <div class="text-center mb-5">
        <a href="//php-2/admin/news/create" class="btn btn-outline-success">Добавить новость</a>
    </div>
</div>