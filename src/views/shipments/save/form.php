<?php

/**
 * @var \app\components\widgets\ActiveForm $form
 * @var \app\models\shipment\Save $model
 */

use app\models\Shipment;
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
                    'content' => Shipment::INVOICE_NUMBER_PREFIX
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
        ->field($model, 'customerId')
        ->widget(Select2::class, [
            'initValueText' => $model->getCustomerIdValueText(),
            'pluginOptions' => [
                'ajax' => [
                    'url' => Url::to(['/customers/autocomplete']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {query:params.term}; }')
                ],
                'minimumInputLength' => 2,
            ]]); ?>
</div>