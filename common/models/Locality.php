<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "locality".
 *
 * @property int $id
 * @property string $title
 * @property string|null $abbreviations
 * @property int|null $parent_id
 * @property int|null $number
 * @property string|null $type
 */
class Locality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'locality';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'number'], 'integer'],
            [['type'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['abbreviations'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'abbreviations' => 'Abbreviations',
            'parent_id' => 'Parent ID',
            'number' => 'Number',
            'type' => 'Type',
        ];
    }

    public function getParent($s)
    {
        return $this->hasMany(self::className(),['id' =>'parent_id'])->where(['like', 'locality.title', $s]);
    }

    public function getLocalityNameById($id){
        $country = Locality::find()->select(['locality.title as loctitle', 'locality.type as loctype', 'l1.title', 'l1.type'])
            ->leftJoin(['l1' => 'locality_con'], 'locality.parent_id = l1.id')
            ->where(['like', 'locality.id', $id])
            ->asArray()
            ->all();

        $i = 0;
        foreach ($country[0] as $locality) {
            if ($i == 0) $countryName = $locality;
            else $countryName = $countryName . ' ' . $locality;
            $i++;
        }

        return $countryName;
    }
}
