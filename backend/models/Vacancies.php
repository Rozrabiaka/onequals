<?php

namespace backend\models;

use Yii;
use common\models\EmployerUsers;
use common\models\Specializations;

/**
 * This is the model class for table "vacancies".
 *
 * @property int $id
 * @property int $employer_id
 * @property int $specialization
 * @property int $country
 * @property string $wage
 * @property string $description
 * @property int|null $employer_type
 *
 * @property EmployerUsers $employer
 * @property EmploymentType $employerType
 * @property Specializations $specialization0
 */
class Vacancies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacancies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employer_id', 'specialization', 'country', 'wage', 'description'], 'required'],
            [['employer_id', 'specialization', 'country', 'employer_type'], 'integer'],
            [['description'], 'string'],
            [['wage'], 'string', 'max' => 255],
            [['specialization'], 'exist', 'skipOnError' => true, 'targetClass' => Specializations::className(), 'targetAttribute' => ['specialization' => 'id']],
            [['employer_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmployerUsers::className(), 'targetAttribute' => ['employer_id' => 'id']],
            [['employer_type'], 'exist', 'skipOnError' => true, 'targetClass' => EmploymentType::className(), 'targetAttribute' => ['employer_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employer_id' => 'Employer ID',
            'specialization' => 'Specialization',
            'country' => 'Country',
            'wage' => 'Wage',
            'description' => 'Description',
            'employer_type' => 'Employer Type',
        ];
    }

    /**
     * Gets query for [[Employer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployer()
    {
        return $this->hasOne(EmployerUsers::className(), ['id' => 'employer_id']);
    }

    /**
     * Gets query for [[EmployerType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployerType()
    {
        return $this->hasOne(EmploymentType::className(), ['id' => 'employer_type']);
    }

    /**
     * Gets query for [[Specialization0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization0()
    {
        return $this->hasOne(Specializations::className(), ['id' => 'specialization']);
    }
}
