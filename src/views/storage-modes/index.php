<?php

declare(strict_types=1);

/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \app\models\storage_mode\Index $filterModel
 */

use app\components\widgets\grid\GridView;
use app\models\StorageMode;
use yii\helpers\Html;

$this->title = 'Условия хранения';

?>

<?php echo GridView::widget([
    'columns' => include(__DIR__ . '/grid/columns.php'),
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'panel' => [
        'after' => false,
        'heading' => $this->title,
    ],
    'toolbar' => Yii::$app->getUser()->can(StorageMode::PERMISSION_MANAGE) ? [
        'content' => Html::a('Создать', ['create'], ['class' => 'btn btn-success'])
    ] : false,
]); ?>