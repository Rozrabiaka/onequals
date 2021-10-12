<?php

namespace common\models;

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

    public $hiddenCountry;
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
            [['employer_id', 'specialization', 'employer_type', 'wage', 'hiddenCountry'], 'integer'],
            [['description', 'country'], 'string'],
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
            'wage' => 'За зарплатою',
            'date' => 'За датою',
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

    public function getCountry()
    {
        return $this->hasOne(Locality::className(), ['id' => 'country']);
    }

    /**
     * Gets query for [[Specialization0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecializations()
    {
        return $this->hasOne(Specializations::className(), ['id' => 'specialization']);
    }

    public function getUser()
    {
        return $this->hasOne(EmployerUsers::className(), ['id' => 'employer_id'])->joinWith('user');
    }
}
