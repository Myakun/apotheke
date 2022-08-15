<?php

declare(strict_types=1);

/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \app\models\storage_cell\Index $filterModel
 */

use app\components\widgets\grid\GridView;
use app\models\StorageCell;
use yii\helpers\Html;

$this->title = 'Ячейки склада';

?>

<?php echo GridView::widget([
    'columns' => include(__DIR__ . '/grid/columns.php'),
    'dataProvider' => $dataProvider,
    'panel' => [
        'after' => false,
        'heading' => $this->title,
    ],
    'toolbar' => Yii::$app->getUser()->can(StorageCell::PERMISSION_MANAGE) ? [
        'content' => Html::a('Создать', ['create'], ['class' => 'btn btn-success'])
    ] : false,
]); ?>