<?php

declare(strict_types=1);

use app\components\widgets\grid\ActionColumn;
use app\models\Product;
use yii\helpers\Html;

return [
    'productName' => [
        'attribute' => 'productName',
        'label' => 'Товар',
    ],
    'series' => [
        'attribute' => 'series',
        'header' => 'Серия',
    ],
    'amount' => [
        'attribute' => 'amount',
        'label' => 'Количество',
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
    'storageCells' => [
        'format' => 'raw',
        'header' => 'Ячейки',
        'value' => function (array $model) {
            $html = '';

            foreach ($model['storageCells'] as $storageCellName => $amount) {
                $html .= $storageCellName . ': ' . $amount . ' шт. <br>';
            }

            return $html;
        },
    ],
];