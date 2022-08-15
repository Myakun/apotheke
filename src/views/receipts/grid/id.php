<?php

use app\models\Receipt;

/**
 * @var Receipt $receipt
 */

?>

<?php echo $receipt->id; ?>
<br>
<small class="text-muted">
    Создал
    <?php echo $receipt->createdBy->name; ?>
    <?php echo Yii::$app->formatter->asDatetime($receipt->created_at); ?>
</small>