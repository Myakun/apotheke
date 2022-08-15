<?php

use app\models\Shipment;

/**
 * @var Shipment $shipment
 */

?>

<?php echo $shipment->id; ?>
<br>
<small class="text-muted">
    Создал
    <?php echo $shipment->createdBy->name; ?>
    <?php echo Yii::$app->formatter->asDatetime($shipment->created_at); ?>
</small>