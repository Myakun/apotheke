<?php

use app\models\StorageMode;

/**
 * @var StorageMode $storageMode
 */

?>

<?php echo $storageMode->id; ?>
<br>
<small class="text-muted">
    Создал
    <?php echo $storageMode->createdBy->name; ?>
    <?php echo Yii::$app->formatter->asDatetime($storageMode->created_at); ?>
</small>