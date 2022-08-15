<?php

declare(strict_types=1);

namespace app\components\web\crud;

use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;

abstract class Model extends \yii\base\Model
{
    public function __construct(
        protected ActiveRecord $entity,
        array $config = []
    ) {
        parent::__construct($config);
    }

    abstract protected function fillEntity(): void;

    public function getEntity(): ActiveRecord
    {
       return $this->entity;
    }

    public function validate($attributeNames = null, $clearErrors = true): bool
    {
        if (!parent::validate($attributeNames, $clearErrors)) {
            return false;
        }

        $this->fillEntity();

        return $this->entity->validate();
    }

    public function save(): void
    {
        $this->entity->save();
    }
}