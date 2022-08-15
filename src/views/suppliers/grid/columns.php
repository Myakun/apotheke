<?php

declare(strict_types=1);

use app\models\Supplier;
use app\components\widgets\grid\ActionColumn;


return [
    'id' => [
        'format' => 'raw',
        'header' => '#',
        'value' => function(Supplier $supplier): string {
            return $this->render('grid/id', [
                'supplier' => $supplier
            ]);
        }
    ],
    'name' => [
        'attribute' => 'name',
        'format' => 'raw',
        'label' => 'Поставщик',
        'value' => function(Supplier $supplier): string {
            return $this->render('grid/supplier', [
                'supplier' => $supplier
            ]);
        }
    ],
    'contract' => [
        'attribute' => 'contractNumber',
        'format' => 'raw',
        'header' => 'Договор',
        'value' => function(Supplier $supplier): string {
            return sprintf(
                '%s от %s',
                Supplier::CONTRACT_NUMBER_PREFIX . $supplier->contract_number,
                Yii::$app->formatter->asDate($supplier->contract_date)
            );
        }
    ],
    [
        'class' => ActionColumn::class,
        'template' => '{update} {delete}',
        'visibleButtons' => [
            'delete' => function (Supplier $supplier)  {
                return empty($supplier->receipts) && Yii::$app->getUser()->can(Supplier::PERMISSION_MANAGE);
            },
            'update' => function ()  {
                return Yii::$app->getUser()->can(Supplier::PERMISSION_MANAGE);
            },
        ]
    ]
];