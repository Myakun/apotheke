<?php

/**
 * @var \app\components\widgets\ActiveForm $form
 * @var \app\models\user\Save $model
 */

echo $form->errorSummary([$model, $model->getEntity()])

?>

<div class="row">
    <div class="col-12 col-md-4">
        <?php
        echo $form
            ->field($model, 'email', [
                'inputOptions' => [
                    'type' => 'email',
                ],
            ]);
        echo $form->field($model, 'name');

        $options = [];
        if ($model->getEntity()->id == Yii::$app->getUser()->getId()) {
            $options['disabled'] = 'disabled';
        }
        echo $form
            ->field($model, 'role', [
                'inputOptions' => $options,
            ])
            ->dropDownList(['' => ''] + $model->getRoleOptions());
        ?>
    </div>
</div>