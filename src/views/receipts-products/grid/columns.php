<?php

declare(strict_types=1);

use app\components\widgets\grid\ActionColumn;
use app\components\widgets\grid\GridView;
use app\models\ReceiptProduct;
use yii\helpers\Url;

$labels = (new ReceiptProduct())->attributeLabels();

$columns = [
    'id' => [
        'format' => 'raw',
        'header' => '#',
        'value' => function(ReceiptProduct $receiptProduct): string {
            return $this->render('@app/views/receipts-products/grid/id', [
                'receiptProduct' => $receiptProduct
            ]);
        }
    ],
    'product_id' => [
        'format' => 'raw',
        'header' => $labels['product_id'],
        'value' => function(ReceiptProduct $receiptProduct): string {
            return $receiptProduct->product->name;
        }
    ],
    'series' => [
        'attribute' => 'series',
        'enableSorting' => false,
    ],
    'production_date' => [
        'header' => $labels['production_date'],
        'value' => function (ReceiptProduct $receiptProduct) {
            return Yii::$app->formatter->asDate($receiptProduct->production_date);
        },
    ],
    'expiration_date' => [
        'header' => $labels['expiration_date'],
        'value' => function (ReceiptProduct $receiptProduct) {
            return Yii::$app->formatter->asDate($receiptProduct->expiration_date);
        },
    ],
    'packages_amount' => [
        'attribute' => 'packages_amount',
        'enableSorting' => false,
    ],
];

if (!isset($disableDelete)) {
    $columns[] =   [
        'class' => ActionColumn::class,
        'template' => '{delete}',
        'visibleButtons' => [
            'delete' => function (ReceiptProduct $receiptProduct) {
                foreach ($receiptProduct->productsStorageCells as $productsStorageCell) {
                    if ($productsStorageCell->out > 0) {
                        return false;
                    }
                }

                return true;
            },
        ]
    ];
}

return $columns;