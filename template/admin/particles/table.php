<?php /**
 * @var \App\Models\Model[] $models
 * @var array               $functions
 */
?>
<table class="table">
    <?php foreach ($models as $model) : ?>
        <tr>
            <?php foreach ($functions as $function) : ?>
                <td>
                    <?php echo $function($model); ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

