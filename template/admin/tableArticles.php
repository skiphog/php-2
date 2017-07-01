<?php
/**
 * @var \App\Models\Model[] $models
 * @var array               $functions
 */
?>
<?php if (!empty($models)) : ?>
    <table class="table">
        <tr>
            <th>Заголовок</th>
            <th>Автор</th>
            <th>Управление</th>
        </tr>
        <?php foreach ($models as $model) : ?>
            <tr>
                <?php foreach ($functions as $function) : ?>
                    <td>
                        <?php echo $function($model); ?>
                    </td>
                <?php endforeach; ?>
                <td>
                    <a href="//php-2/admin/news/edit?id=<?php echo $model->id; ?>"
                            class="btn btn-outline-primary btn-sm">
                        Редактировать
                    </a>
                    <a href="//php-2/admin/news/delete?id=<?php echo $model->id; ?>"
                            class="btn btn-outline-danger btn-sm" onclick="return false">
                        Удалить
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif;