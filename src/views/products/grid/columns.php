<?php

declare(strict_types=1);

use app\components\widgets\grid\ActionColumn;
use app\models\Product;
use yii\helpers\Html;

$labels = (new Product())->attributeLabels();

return [
    'id' => [
        'format' => 'raw',
        'header' => '#',
        'value' => function(Product $product): string {
            return $this->render('grid/id', [
                'product' => $product
            ]);
        }
    ],
    'name',
    'producer_id' => [
        'format' => 'raw',
        'header' => $labels['producer_id'],
        'value' => function (Product $product) {
            return Html::a($product->producer->name, ['/producers/update', 'id' => $product->producer_id]);
        },
    ],
    'storage_mode_id' => [
        'format' => 'raw',
        'header' => $labels['storage_mode_id'],
        'value' => function (Product $product) {
            return $product->storageMode->name;
        },
    ],
    'package_volume',
    [
        'class' => ActionColumn::class,
        'visibleButtons' => [
            'delete' => function (Product $product)  {
                return empty($product->receiptsProducts) && Yii::$app->getUser()->can(Product::PERMISSION_MANAGE);
            },
            'update' => function ()  {
                return Yii::$app->getUser()->can(Product::PERMISSION_MANAGE);
            },
        ]
    ]
];