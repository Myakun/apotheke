<?php

use app\models\Producer;

/**
 * @var Producer $producer
 */

?>

<?php echo $producer->id; ?>
<br>
<small class="text-muted">
    Создал
    <?php echo $producer->createdBy->name; ?>
    <?php echo Yii::$app->formatter->asDatetime($producer->created_at); ?>
</small>