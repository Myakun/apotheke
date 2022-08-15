<?php

/**
 * @var \app\components\widgets\ActiveForm $form
 * @var \app\models\storage_cell\Save $model
 */

use app\models\StorageCell;

echo $form->errorSummary([$model, $model->getEntity()])

?>

<div class="row">
    <div class="col-4 col-md-1">
        <?php echo $form
            ->field($model, 'rowNumber')
            ->dropDownList([0 => ''] + $model->getRowNumberOptions()); ?>
    </div>
    <div class="col-4 col-md-1">
        <?php echo $form
            ->field($model, 'rackNumber')
            ->dropDownList([0 => ''] + $model->getRackNumberOptions()); ?>
    </div>
    <div class="col-4 col-md-1">
        <?php echo $form
            ->field($model, 'shelfNumber')
            ->dropDownList(['' => ''] + StorageCell::getShelfNumberOptions()); ?>
    </div>
</div>

<?php if ($model->getEntity()->getIsNewRecord() || empty($model->getEntity()->productsStorageCells)) { ?>
    <div class="row">
        <div class="col-12 col-md-2">
            <?php echo $form->field($model, 'volume'); ?>
        </div>
    </div>
<?php } ?>

<div class="row">
    <div class="col-12 col-md-2">
        <?php echo $form
            ->field($model, 'storageModeId')
            ->dropDownList([0 => ''] + $model->getStorageModeIdOptions()); ?>
    </div>
</div>
<?php

$js = <<< JS
    $('#save-volume').on('change', function() {
        let input = $(this);
        let value = parseInt(input.val());
        if (isNaN(value) || value < 1) {
            value = '';
        }
        input.val(value);
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_READY);