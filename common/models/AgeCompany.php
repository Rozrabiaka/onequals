<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "age_company".
 *
 * @property int $id
 * @property string $age_name
 *
 * @property EmployerUsers[] $employerUsers
 */
class AgeCompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'age_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['age_name'], 'required'],
            [['age_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'age_name' => 'Age Name',
        ];
    }

    /**
     * Gets query for [[EmployerUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployerUsers()
    {
        return $this->hasMany(EmployerUsers::className(), ['age_company' => 'id']);
    }

    public function getRadioList(){
        $list = $this::find()->asArray()->all();

        $listArray = array();
        foreach ($list as $data) {
            $listArray[$data['id']] =  $data['age_name'];
        }

        return $listArray;
    }
}
