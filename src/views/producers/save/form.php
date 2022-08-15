<?php

/**
 * @var \app\components\widgets\ActiveForm $form
 * @var \app\models\producer\Save $model
 */

echo $form->errorSummary([$model, $model->getEntity()])

?>

<div class="row">
    <div class="col-12 col-md-4">
        <?php echo $form->field($model, 'name'); ?>
    </div>
</div>