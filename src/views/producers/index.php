<?php

declare(strict_types=1);

use app\components\widgets\grid\GridView;
use app\models\Producer;
use yii\helpers\Html;

/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 * @var \app\models\producer\Index $filterModel
 */

$this->title = 'Производители';

?>

<?php echo GridView::widget([
    'columns' => include(__DIR__ . '/grid/columns.php'),
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'panel' => [
        'after' => false,
        'heading' => $this->title,
    ],
    'toolbar' => Yii::$app->getUser()->can(Producer::PERMISSION_MANAGE) ? [
        'content' => Html::a('Создать', ['create'], ['class' => 'btn btn-success'])
    ] : false,
]); ?>