<?php

declare(strict_types=1);

use app\assets\App\App;
use app\components\assets\FontAwesome;
use app\models\Customer;
use app\models\Producer;
use app\models\Product;
use app\models\ProductStorageCell;
use app\models\Receipt;
use app\models\Shipment;
use app\models\StorageCell;
use app\models\StorageMode;
use app\models\Supplier;
use app\models\User;
use kartik\nav\NavX;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

/**
 * @var string $content
 */

?>
<?php $this->beginPage() ?>
    <!doctype html>
    <html lang="en">
        <head>
            <?php $scheme = Yii::$app->getRequest()->getIsSecureConnection() ? 'https' : 'http'; ?>
            <base href="<?php echo $scheme . '://' . Yii::$app->getRequest()->getServerName() . Yii::$app->getRequest()->getBaseUrl(); ?>">
            <meta charset="utf-8">
            <meta name=viewport content="width=device-width, initial-scale=1">
            <title><?php echo Html::encode($this->title); ?></title>
            <?php echo Html::csrfMetaTags(); ?>
            <?php FontAwesome::register($this); ?>
            <?php App::register($this); ?>
            <?php $this->head(); ?>
        </head>
        <body class="<?php echo Yii::$app->language; ?>">
            <?php $this->beginBody() ?>
            <header class="mb-4">
                <?php
                NavBar::begin([
                    'brandLabel' => 'Склад',
                    'innerContainerOptions' => [
                        'class' => 'container-fluid'
                    ]
                ]);
                echo NavX::widget([
                    'activateParents' => true,
                    'options' => ['class' => 'navbar-nav'],
                    'encodeLabels' => false,
                    'items' => [
                        [
                            'items' => [
                                [
                                    'label' => 'Товары',
                                    'url' => ['products/index'],
                                    'visible' => Yii::$app->user->can(Product::PERMISSION_LIST)
                                ], [
                                    'label' => 'Производители',
                                    'url' => ['producers/index'],
                                    'visible' => Yii::$app->user->can(Producer::PERMISSION_LIST)
                                ], [
                                    'label' => 'Условия хранения',
                                    'url' => ['storage-modes/index'],
                                    'visible' => Yii::$app->user->can(StorageMode::PERMISSION_LIST)
                                ]
                            ],
                            'label' => 'Товары',
                            'url' => ['#'],
                            'visible' =>
                                Yii::$app->user->can(Producer::PERMISSION_LIST)
                                || Yii::$app->user->can(Product::PERMISSION_LIST)
                                || Yii::$app->user->can(StorageMode::PERMISSION_LIST)
                        ], [
                            'items' => [
                                [
                                    'label' => 'Приходы',
                                    'url' => ['receipts/index'],
                                    'visible' => Yii::$app->user->can(Receipt::PERMISSION_LIST)
                                ], [
                                    'label' => 'Отгрузки',
                                    'url' => ['shipments/index'],
                                    'visible' => Yii::$app->user->can(Shipment::PERMISSION_LIST)
                                ], [
                                    'label' => 'Остатки',
                                    'url' => ['products-storage-cells/index'],
                                    'visible' => Yii::$app->user->can(ProductStorageCell::PERMISSION_LIST)
                                ], [
                                    'label' => 'Ячейки склада',
                                    'url' => ['storage-cells/index'],
                                    'visible' => Yii::$app->user->can(StorageCell::PERMISSION_LIST)
                                ]
                            ],
                            'label' => 'Склад',
                            'url' => ['#'],
                            'visible' =>
                                Yii::$app->user->can(ProductStorageCell::PERMISSION_LIST)
                                || Yii::$app->user->can(Receipt::PERMISSION_LIST)
                                || Yii::$app->user->can(Shipment::PERMISSION_LIST)
                                || Yii::$app->user->can(StorageCell::PERMISSION_LIST)
                        ], [
                            'items' => [
                                [
                                    'label' => 'Клиенты',
                                    'url' => ['customers/index'],
                                    'visible' => Yii::$app->user->can(Customer::PERMISSION_LIST)
                                ], [
                                    'label' => 'Поставщики',
                                    'url' => ['suppliers/index'],
                                    'visible' => Yii::$app->user->can(Supplier::PERMISSION_LIST)
                                ]
                            ],
                            'label' => 'Договора',
                            'url' => ['#'],
                            'visible' =>
                                Yii::$app->user->can(Customer::PERMISSION_LIST)
                                || Yii::$app->user->can(Supplier::PERMISSION_LIST)
                        ], [
                            'items' => [
                                [
                                    'label' => 'Поступления товаров',
                                    'url' => ['statistics/receipts-products-from-suppliers'],
                                ], [
                                    'label' => 'Отгрузки клиентам',
                                    'url' => ['statistics/shipments-products-to-customers'],
                                ], [
                                    'label' => 'Количество отгруженных товаров',
                                    'url' => ['statistics/products-amount'],
                                ],
                            ],
                            'label' => 'Отчеты',
                            'url' => ['statistics/index'],
                            'visible' => Yii::$app->user->can('statistics')
                        ], [
                            'label' => 'Пользователи',
                            'url' => ['users/index'],
                            'visible' => Yii::$app->getUser()->can(User::PERMISSION_MANAGE)
                        ]
                    ],
                ]);
                echo NavX::widget([
                    'activateParents' => true,
                    'options' => ['class' => 'navbar-nav ms-auto'],
                    'encodeLabels' => false,
                    'items' => [
                        [
                            'label' => 'Выход',
                            'url' => 'user/logout'
                        ],
                    ]
                ]);
                NavBar::end();
                ?>
            </header>

            <div class="container-fluid">
                <?php if (Yii::$app->getSession()->hasFlash('successMessage')) { ?>
                    <div class="alert alert-success">
                        <?php echo Yii::$app->getSession()->getFlash('successMessage'); ?>
                    </div>
                <?php } ?>
                <?php echo $content; ?>
            </div>

            <?php $this->endBody(); ?>
        </body>
    </html>
<?php $this->endPage() ?>

