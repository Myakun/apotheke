<?php

use app\components\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;

/**
 * @var \app\models\statistics\ReceiptsProductsFromSuppliers $model
 */

?>

<div class="card">
    <div class="card-header <?php if ($model->filterEnabled()) { ?>bg-primary text-white<?php } ?>">
        <div class="panel-title">
            Фильтр  <?php if ($model->filterEnabled()) { ?>применен<?php } ?>
        </div>
    </div>
    <?php $form = ActiveForm::begin(['method'=>'get']); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12">
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
                            'allowClear' => true,
                            'minimumInputLength' => 2,
                            'placeholder' => '',
                        ]]); ?>
            </div>
            <div class="col-lg-2 col-md-4 col-xs-12">
                <?php echo $form
                    ->field($model, 'invoiceDateFrom')
                    ->widget(DatePicker::class, [
                        'attribute2' => 'invoiceDateTo',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'dd.mm.yyyy'
                        ],
                        'separator' => '-',
                        'type' => DatePicker::TYPE_RANGE,
                    ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12">
                <?php echo $form
                    ->field($model, 'productId')
                    ->widget(Select2::class, [
                        'initValueText' => $model->getProductIdValueText(),
                        'pluginOptions' => [
                            'ajax' => [
                                'url' => Url::to(['/products/autocomplete']),
                                'dataType' => 'json',
                                'data' => new JsExpression('function(params) { return {query:params.term, useId: true}; }')
                            ],
                            'allowClear' => true,
                            'minimumInputLength' => 2,
                            'placeholder' => '',
                        ]]); ?>
            </div>
            <div class="col-lg-2 col-md-3 col-xs-12">
                <?php echo $form
                    ->field($model, 'series')
                    ->widget(Select2::class, [
                        'initValueText' => $model->series,
                        'pluginOptions' => [
                            'ajax' => [
                                'url' => Url::to(['/products-storage-cells/autocomplete-series']),
                                'dataType' => 'json',
                                'data' => new JsExpression('function(params) { return {query:params.term}; }')
                            ],
                            'allowClear' => true,
                            'minimumInputLength' => 2,
                            'placeholder' => '',
                        ]]); ?>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <button class="btn btn-primary" type="submit">Применить фильтр</button>
            <?php if ($model->filterEnabled()) { ?>
                <a class="btn btn-danger" href="/statistics/shipments-products-to-customers/index">Сбросить фильтр</a>
            <?php } ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>


