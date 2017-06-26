<?php
/**
 * @var $articles \App\Models\Article[]
 * @var $authors  \App\Models\Author[]
 */
?>
<h1>Управление новостями</h1>
<?php if (!empty($articles)) : ?>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <p><?php echo $article->title; ?></p>
                <p><?php echo $article->text; ?></p>
                <p><?php echo !empty($article->author) ? $article->author->name : 'Нет автора'; ?></p>
                <a href="/admin/news/edit?id=<?php echo $article->id; ?>">Редактировать</a>
                <a href="/admin/news/delete?id=<?php echo $article->id; ?>">Удалить</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<!-- Форма добавления новости -->
<form action="/admin/news/save" method="post">
    <input type="text" name="title" placeholder="title">
    <br>
    <textarea name="text" id="" cols="30" rows="10" placeholder="text"></textarea>
    <br>
    <?php if (!empty($authors)) : ?>
        <label>
            <select name="author_id">
                <?php foreach ($authors as $author) : ?>
                    <option value="<?php echo $author->id; ?>"><?php echo $author->name; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    <?php endif; ?>
    <br>
    <input type="submit" value="Добавить">
</form>
