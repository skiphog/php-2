<?php
require __DIR__ . '/../../autoload.php';

use App\Models\Article;

if (isset($_GET['edit'])) {
    $article = Article::findById((int)$_GET['edit']);

    if (empty($article)) {
        http_response_code(404);
        die;
    }

    include __DIR__ . '/../../template/admin/edit.php';
}
