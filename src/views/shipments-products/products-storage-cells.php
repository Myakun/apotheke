<?php

declare(strict_types=1);

/**
 * @var int $productId
 */

use app\widgets\ProductsStorageCells\ProductsStorageCells;

echo ProductsStorageCells::widget([
    'productId' => $productId,
]);


