<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "summary".
 *
 * @property int $id
 * @property int $worker_id
 * @property string $company_name
 * @property int $specialization
 * @property int $country
 * @property string $wage
 * @property string $description
 * @property int $employer_type
 *
 * @property EmploymentType $employerType
 * @property Specializations $specialization0
 * @property EmployerUsers $worker
 * @property SearchWorkUser $worker0
 */
class Summary extends \yii\db\ActiveRecord
{
    public $hiddenCountry;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'summary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['worker_id', 'specialization', 'country', 'description', 'employer_type'], 'required'],
            [['worker_id', 'specialization',  'employer_type'], 'integer'],
            [['description', 'country'], 'string'],
            [['wage'], 'string', 'max' => 255],
            [['employer_type'], 'exist', 'skipOnError' => true, 'targetClass' => EmploymentType::className(), 'targetAttribute' => ['employer_type' => 'id']],
            [['specialization'], 'exist', 'skipOnError' => true, 'targetClass' => Specializations::className(), 'targetAttribute' => ['specialization' => 'id']],
            [['worker_id'], 'exist', 'skipOnError' => true, 'targetClass' => SearchWorkUser::className(), 'targetAttribute' => ['worker_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'worker_id' => 'Worker ID',
            'company_name' => 'Company Name',
            'specialization' => 'Specialization',
            'country' => 'Country',
            'wage' => 'За зарплатою',
            'date' => 'За датою',
            'description' => 'Description',
            'employer_type' => 'Employer Type',
        ];
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
    public function getSpecializations()
    {
        return $this->hasOne(Specializations::className(), ['id' => 'specialization']);
    }

    public function getLocality()
    {
        return $this->hasOne(Locality::className(), ['id' => 'country']);
    }

    /**
     * Gets query for [[Worker0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorker()
    {
        return $this->hasOne(SearchWorkUser::className(), ['id' => 'worker_id']);
    }

    public function getUser()
    {
        return $this->hasOne(SearchWorkUser::className(), ['id' => 'worker_id'])->joinWith('user');
    }
}
