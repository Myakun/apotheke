<?php

/**
 * @var \app\models\ReceiptProduct $receiptProduct
 */

?>

<?php echo $receiptProduct->id; ?>
<br>
<small class="text-muted">
    Создал
    <?php echo $receiptProduct->createdBy->name; ?>
    <?php echo Yii::$app->formatter->asDatetime($receiptProduct->created_at); ?>
</small>