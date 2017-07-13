<?php /** @var $articles \App\Models\Article[] */
use App\Component\Auth; ?>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<div class="container">
    <h1 class="text-center">Управление новостями</h1>
    <?php /*if (Auth::getInstance()->check()) : */ ?><!--
        <h2><?php /*echo Auth::getInstance()->user()->name; */ ?></h2>
    --><?php /*endif; */ ?>
    <?php
    echo (new \App\View\AdminDataTable($articles, require __DIR__ . '/../../app/View/funcArticles.php'))
        ->render(__DIR__ . '/../../template/admin/tableArticles.php');
    ?>
    <div class="text-center mb-5">
        <a href="//php-2/admin/news/create" class="btn btn-outline-success">Добавить новость</a>
    </div>
</div>