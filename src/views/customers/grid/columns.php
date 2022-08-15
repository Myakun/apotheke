<?php

declare(strict_types=1);

use app\models\Customer;
use app\components\widgets\grid\ActionColumn;


return [
    'id' => [
        'format' => 'raw',
        'header' => '#',
        'value' => function(Customer $customer): string {
            return $this->render('grid/id', [
                'customer' => $customer
            ]);
        }
    ],
    'name' => [
        'attribute' => 'name',
        'format' => 'raw',
        'label' => 'Клиент',
        'value' => function(Customer $customer): string {
            return $this->render('grid/customer', [
                'customer' => $customer
            ]);
        }
    ],
    'contract' => [
        'attribute' => 'contractNumber',
        'format' => 'raw',
        'header' => 'Договор',
        'value' => function(Customer $customer): string {
            return sprintf(
                '%s от %s',
                Customer::CONTRACT_NUMBER_PREFIX . $customer->contract_number,
                Yii::$app->formatter->asDate($customer->contract_date)
            );
        }
    ],
    [
        'class' => ActionColumn::class,
        'template' => '{update} {delete}',
        'visibleButtons' => [
            'delete' => function (Customer $customer)  {
                return empty($customer->shipments) && Yii::$app->getUser()->can(Customer::PERMISSION_MANAGE);
            },
            'update' => function ()  {
                return Yii::$app->getUser()->can(Customer::PERMISSION_MANAGE);
            },
        ]
    ]
];