<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "history".
 *
 * @property int $id
 * @property string $img
 * @property string $description
 * @property string $date
 */
class History extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string'],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Img',
            'description' => 'Description',
            'date' => 'Date',
        ];
    }

    public function getHistoryImages()
    {
        return $this->hasMany(self::className(), ['id' => 'id']);
    }

    public function getImagesLinks()
    {
        return ArrayHelper::getColumn($this->historyImages, 'img');
    }

    public function getImagesLinksData()
    {
        return ArrayHelper::toArray($this->historyImages, [
            self::className() => [
                'key' => 'id'
            ]
        ]);
    }
}
