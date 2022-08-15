<?php

declare(strict_types=1);

use app\components\widgets\grid\ActionColumn;
use app\models\Product;
use yii\helpers\Html;

return [

    'productName' => [
        'attribute' => 'productName',
        'header' => 'Товар',
    ],
    'amount' => [
        'attribute' => 'amount',
        'label' => 'Количество',
    ],
    'month' => [
        'attribute' => 'month',
        'group' => true,
        'label' => 'Месяц',
    ],
];