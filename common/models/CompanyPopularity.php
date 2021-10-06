<?php

namespace common\models;

use common\models\EmployerUsers;
use Yii;

/**
 * This is the model class for table "company_popularity".
 *
 * @property int $id
 * @property string $company_popularity
 *
 * @property EmployerUsers[] $employerUsers
 */
class CompanyPopularity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_popularity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_popularity'], 'required'],
            [['company_popularity'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_popularity' => 'Company Popularity',
        ];
    }

    /**
     * Gets query for [[EmployerUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployerUsers()
    {
        return $this->hasMany(EmployerUsers::className(), ['company_popularity' => 'id']);
    }

    public function getRadioList(){
        $list = $this::find()->asArray()->all();

        $listArray = array();
        foreach ($list as $data) {
            $listArray[$data['id']] =  $data['company_popularity'];
        }

        return $listArray;
    }
}
