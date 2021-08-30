<?php

namespace common\models;

use common\models\EmployerUsers;
use common\models\SearchWorkUser;

use Yii;

/**
 * This is the model class for table "specializations".
 *
 * @property int $id
 * @property string $name
 *
 * @property EmployerUsers[] $employerUsers
 * @property EmployerUsers[] $employerUsers0
 * @property SearchWorkUser[] $searchWorkUsers
 */
class Specializations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specializations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[EmployerUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployerUsers()
    {
        return $this->hasMany(EmployerUsers::className(), ['specialization' => 'id']);
    }

    /**
     * Gets query for [[EmployerUsers0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployerUsers0()
    {
        return $this->hasMany(EmployerUsers::className(), ['specialization' => 'id']);
    }

    /**
     * Gets query for [[SearchWorkUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSearchWorkUsers()
    {
        return $this->hasMany(SearchWorkUser::className(), ['specialization' => 'id']);
    }
}
