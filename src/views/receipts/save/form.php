<?php

/**
 * @var \app\components\widgets\ActiveForm $form
 * @var \app\models\receipt\Save $model
 */

use app\models\Receipt;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;

echo $form->errorSummary([$model, $model->getEntity()])

?>

<div class="row">
    <div class="col-6 col-md-4 col-lg-3">
        <?php echo $form->field($model, 'invoiceNumber', [
            'addon' => [
                'prepend' => [
                    'content' => Receipt::INVOICE_NUMBER_PREFIX
                ]
            ]
        ]); ?>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <?php echo $form
            ->field($model, 'invoiceDate')
            ->widget(DatePicker::class, [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ],
                'type' => DatePicker::TYPE_INPUT,
            ])?>
    </div>
</div>

<div class="col-12 col-md-4 col-lg-3">
    <?php echo $form
        ->field($model, 'supplierId')
        ->widget(Select2::class, [
            'initValueText' => $model->getSupplierIdValueText(),
            'pluginOptions' => [
                'ajax' => [
                    'url' => Url::to(['/suppliers/autocomplete']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {query:params.term}; }')
                ],
                'minimumInputLength' => 2,
            ]]); ?>
</div>