<?php
/**
 * @var $article App\Models\Article
 * @var $authors App\Models\Author[]
 * @var $errors  App\Exceptions\MultiException
 */
?>
<link rel="stylesheet" href="/css/bootstrap.min.css">
<div class="container">
    <?php if (isset($errors) && !$errors->isEmpty()) : ?>
        <div class="alert alert-danger mb-3">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error->getMessage(); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <h1>
        <?php if ($article->isNew()) : ?>
            Добаление новости
        <?php else : ?>
            Редактирование новости
        <?php endif; ?>
    </h1>

    <form action="//php-2/admin/news/save" method="post">
        <input type="hidden" name="id" value="<?php echo $article->id; ?>">
        <div class="form-group">
            <input type="text" name="title" class="form-control" placeholder="Заголовок"
                    value="<?php echo html($article->title); ?>">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="text" rows="15"
                    placeholder="Текст новости"><?php echo $article->text; ?></textarea>
        </div>
        <?php if (!empty($authors)) : ?>
            <div class="form-group">
                <label for="author_id">Автор</label>
                <select class="form-control" id="author_id" name="author_id">
                    <option value="0">Не выбрано</option>
                    <?php foreach ($authors as $author) : ?>
                        <option value="<?php echo $author->id; ?>"
                            <?php if ($article->author_id === $author->id) : ?>
                                selected
                            <?php endif; ?>
                        ><?php echo $author->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="//php-2/admin/news/index" class="btn btn-outline-warning">Назад</a>
    </form>

</div>


