<?php /** @var $article \App\Models\Article */ ?>

<?php var_dump($errors) ?>

<form action="/admin/news/update" method="post">
    <input type="hidden" name="id" value="<?php echo $article->id; ?>">
    <input type="text" name="title" placeholder="title" value="<?php echo $article->title; ?>">
    <br>
    <textarea name="text" id="" cols="30" rows="10" placeholder="text"><?php echo $article->text; ?></textarea>
    <br>
    <input type="text" name="author" placeholder="author"
            value="<?php echo !empty($article->author) ? $article->author->name : 'Нет автора'; ?>"
            disabled>
    <br>
    <input type="submit" value="Сохранить">
</form>


