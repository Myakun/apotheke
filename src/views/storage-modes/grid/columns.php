<?php

declare(strict_types=1);

use app\models\StorageMode;
use app\components\widgets\grid\ActionColumn;

return [
    'id' => [
        'format' => 'raw',
        'header' => '#',
        'value' => function(StorageMode $storageMode): string {
            return $this->render('grid/id', [
                'storageMode' => $storageMode
            ]);
        }
    ],
    'name' => [
        'attribute' => 'name',
    ], [
        'class' => ActionColumn::class,
        'visibleButtons' => [
            'delete' => function (StorageMode $storageMode) {
                return count($storageMode->products) == 0 && Yii::$app->getUser()->can(StorageMode::PERMISSION_MANAGE);
            },
            'update' => function ()  {
                return Yii::$app->getUser()->can(StorageMode::PERMISSION_MANAGE);
            },
        ],
    ]
];