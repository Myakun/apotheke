<?php

use app\components\widgets\grid\GridView;

/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

echo GridView::widget([
    'columns' => include(__DIR__ . '/../shipments-products/grid/columns.php'),
    'dataProvider' => $dataProvider,
    'panel' => false,
    'toolbar' => false
]);