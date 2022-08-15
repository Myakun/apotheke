<?php

declare(strict_types=1);

namespace app\models;

use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * @property User $createdBy
 * @property int $id
 * @property string $name
 * @property Product[] $products
 */
class StorageMode extends ActiveRecord
{
    public const NAME_MAX_LENGTH = 30;

    public const PERMISSION_LIST = 'listStorageModes';

    public const PERMISSION_MANAGE = 'manageStorageModes';

    #[ArrayShape(['name' => "string"])]
    public function attributeLabels(): array
    {
        return [
            'name' => 'Условия хранения',
        ];
    }

    #[ArrayShape(['blameable' => "array", 'timestamp' => "array"])]
    public function behaviors(): array
    {
        return [
            'blameable' => [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false,
            ],
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()')
            ],
        ];
    }

    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getProducts(): ActiveQuery
    {
        return $this->hasMany(Product::class, ['storage_mode_id' => 'id']);
    }

    public function rules(): array
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => self::NAME_MAX_LENGTH],
            ['name', 'unique'],
        ];
    }

    public static function tableName(): string
    {
        return 'storage_modes';
    }
}
