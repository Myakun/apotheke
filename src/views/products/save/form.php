<?php

/**
 * @var \app\components\widgets\ActiveForm $form
 * @var \app\models\product\Save $model
 */

use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;

echo $form->errorSummary([$model, $model->getEntity()])

?>

<div class="row">
    <div class="col-12 col-md-4">
        <?php echo $form
            ->field($model, 'name')
            ->widget(Select2::class, [
                'initValueText' => $model->name,
                'pluginOptions' => [
                    'ajax' => [
                        'url' => Url::to(['/products/autocomplete']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {query:params.term}; }')
                    ],
                    'minimumInputLength' => 2,
                    'tags' => true,
                ]]); ?>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-4">
        <?php echo $form
            ->field($model, 'producer')
            ->widget(Select2::class, [
                'initValueText' => $model->getEntity()->getIsNewRecord() ? '' : $model->producer,
                'pluginOptions' => [
                    'ajax' => [
                        'url' => Url::to(['/producers/autocomplete']),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {query:params.term}; }')
                    ],
                    'minimumInputLength' => 2,
                    'tags' => true,
                ]]); ?>
    </div>
</div>


<div class="row mt-3">
    <div class="col-12 col-md-2">
        <?php echo $form
            ->field($model, 'storageModeId')
            ->dropDownList([0 => ''] + $model->getStorageModeIdOptions()); ?>
    </div>
    <?php if ($model->getEntity()->getIsNewRecord() || empty($model->getEntity()->receiptsProducts)) { ?>
        <div class="col-12 col-md-2">
            <?php echo $form
                ->field($model, 'packageVolume')
                ->textInput(['value' => $model->getEntity()->package_volume]); ?>
        </div>
    <?php } ?>
</div>

<?php

$js = <<< JS
    $('#save-packagevolume, #save-packagesamount').on('change', function() {
        let input = $(this);
        let value = parseInt(input.val());
        if (isNaN(value) || value < 1) {
            value = '';
        }
        input.val(value);
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_READY);