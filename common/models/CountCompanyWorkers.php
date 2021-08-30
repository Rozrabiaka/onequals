<?php

namespace common\models;


use Yii;

/**
 * This is the model class for table "count_company_workers".
 *
 * @property int $id
 * @property string $count_company_workers
 *
 * @property EmployerUsers[] $employerUsers
 */
class CountCompanyWorkers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'count_company_workers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count_company_workers'], 'required'],
            [['count_company_workers'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'count_company_workers' => 'Count Company Workers',
        ];
    }

    /**
     * Gets query for [[EmployerUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployerUsers()
    {
        return $this->hasMany(EmployerUsers::className(), ['count_company_workers' => 'id']);
    }
}
