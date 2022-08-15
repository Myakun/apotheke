<?php

declare(strict_types=1);

/**
 * @var int $packagesAmount
 * @var int $productId
 * @var string $series
 */

use app\widgets\StorageCells\StorageCells;

echo StorageCells::widget([
    'productId' => $productId,
    'packagesAmount' => $packagesAmount,
    'series' => $series,
]);


