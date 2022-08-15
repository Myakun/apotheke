<?php

/**
 * @var \app\components\widgets\ActiveForm $form
 * @var \app\models\supplier\Save $model
 */

use app\models\Supplier;
use kartik\widgets\DatePicker;

echo $form->errorSummary([$model, $model->getEntity()])

?>

<div class="row">
    <div class="col-12 col-md-6">
        <?php echo $form->field($model, 'name'); ?>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6">
        <?php echo $form->field($model, 'address'); ?>
    </div>
</div>

<div class="row">
    <div class="col-6 col-md-4 col-lg-3">
        <?php echo $form->field($model, 'contractNumber', [
            'addon' => [
                'prepend' => [
                    'content' => Supplier::CONTRACT_NUMBER_PREFIX
                ]
            ]
        ]); ?>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <?php echo $form
            ->field($model, 'contractDate')
            ->widget(DatePicker::class, [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ],
                'type' => DatePicker::TYPE_INPUT,
            ])?>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-4 col-lg-3">
        <?php echo $form->field($model, 'contactPerson'); ?>
    </div>
    <div class="col-12 col-md-3 col-lg-3">
        <?php echo $form
            ->field($model, 'phone')
            ->widget(\yii\widgets\MaskedInput::class, [
                'mask' => '+7 (999) 999-99-99'
            ]); ?>
    </div>
</div>