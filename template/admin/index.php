<?php /**  @var $articles \App\Models\Article[] */ ?>
<h1>Управление новостями</h1>
<?php if (!empty($articles)) : ?>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <p><?php echo $article->title; ?></p>
                <p><?php echo $article->text; ?></p>
                <a href="/admin/edit.php?edit=<?php echo $article->id; ?>">Редактировать</a>
                <a href="/admin/handlers/del.php?del=<?php echo $article->id; ?>">Удалить</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<!-- Форма добавления новости -->
<form action="/admin/handlers/add.php" method="post">
    <input type="text" name="title" placeholder="title">
    <br>
    <textarea name="text" id="" cols="30" rows="10" placeholder="text"></textarea>
    <br>
    <input type="text" name="author" placeholder="author">
    <br>
    <input type="submit" value="Добавить">
</form>
