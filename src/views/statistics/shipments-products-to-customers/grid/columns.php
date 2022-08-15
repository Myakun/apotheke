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
    'customer' => [
        'attribute' => 'customer',
        'header' => 'Клиент',
        'group' => true,
    ],
    'invoiceNumber' => [
        'attribute' => 'invoiceNumber',
        'header' => 'Номер накладной',
        'group' => true,
    ],
    'invoiceDate' => [
        'attribute' => 'invoiceDate',
        'label' => 'Дата накладной',
    ],
    'series' => [
        'attribute' => 'series',
        'header' => 'Серия',
    ],
    'productionDate' => [
        'attribute' => 'productionDate',
        'label' => 'Дата производства',
    ],
    'expirationDate' => [
        'attribute' => 'expirationDate',
        'label' => 'Срок годности',
    ],
];