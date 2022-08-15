<?php

declare(strict_types=1);

use app\components\widgets\grid\GridView;
use app\models\Product;
use yii\helpers\Html;

/**
 * @var \yii\data\ArrayDataProvider $dataProvider
 * @var Product $product
 */

echo GridView::widget([
    'columns' => [
        'storageCell' => [
            'attribute' => 'storageCell',
            'header' => 'Ячейка',
        ],
        'series' => [
            'attribute' => 'series',
            'header' => 'Серия',
        ],

        'amount' => [
            'attribute' => 'amount',
            'format' => 'raw',
            'label' => 'Количество',
            'value' => function (array $model) {
                $options = [];
                for ($i = 0; $i <= $model['amount']; $i++) {
                    $options[$i] = $i;
                }

                $html = Html::dropDownList('amounts[' . $model['productStorageCellId'] . ']', 0, $options);
                $html .= '&nbsp; из ' . $model['amount'];

                return $html;
            },
        ],
        'productionDate' => [
            'attribute' => 'productionDate',
            'label' => 'Дата производства',
        ],
        'expirationDate' => [
            'attribute' => 'expirationDate',
            'label' => 'Срок годности',
        ],
        'expirationPercentage' => [
            'attribute' => 'expirationPercentage',
            'label' => 'Процент срока годности',
            'value' => function (array $model) {
                return $model['expirationPercentage'] . '%';
            },
        ],
    ],
    'dataProvider' => $dataProvider,
    'panel' => [
        'after' => false,
        'heading' => $product->name,
    ],
    'rowOptions' => function(array $model) {
        if ($model['expirationPercentage'] <= 10) {
            return ['class' => 'table-danger'];
        }

        if ($model['expirationPercentage'] <= 20) {
            return ['class' => 'table-warning'];
        }
    },
    'toolbar' => false
]);