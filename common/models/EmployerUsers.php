<?php

namespace common\models;

use common\models\CountCompanyWorkers;
use common\models\CompanyPopularity;

use Yii;

/**
 * This is the model class for table "employer_users".
 *
 * @property int $id
 * @property int $user_id
 * @property string $company_name
 * @property string $email
 * @property int $specialization
 * @property string $webpage
 * @property string $facebook
 * @property string $instagram
 * @property string $twitter
 * @property string $LinkedIn
 * @property int $age_company
 * @property int $count_company_workers
 * @property int $company_popularity
 * @property string $company_description
 * @property int $country
 *
 * @property AgeCompany $ageCompany
 * @property CompanyPopularity $companyPopularity
 * @property CountCompanyWorkers $countCompanyWorkers
 * @property Specializations $specialization0
 * @property Specializations $specialization1
 * @property User $user
 */
class EmployerUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employer_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'company_name', 'email', 'specialization', 'webpage', 'facebook', 'instagram', 'twitter', 'LinkedIn', 'age_company', 'count_company_workers', 'company_popularity', 'company_description', 'country'], 'required'],
            [['user_id', 'specialization', 'age_company', 'count_company_workers', 'company_popularity', 'country'], 'integer'],
            [['company_description'], 'string'],
            [['company_name', 'email', 'webpage', 'facebook', 'instagram', 'twitter', 'LinkedIn'], 'string', 'max' => 255],
            [['age_company'], 'exist', 'skipOnError' => true, 'targetClass' => AgeCompany::className(), 'targetAttribute' => ['age_company' => 'id']],
            [['company_popularity'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyPopularity::className(), 'targetAttribute' => ['company_popularity' => 'id']],
            [['count_company_workers'], 'exist', 'skipOnError' => true, 'targetClass' => CountCompanyWorkers::className(), 'targetAttribute' => ['count_company_workers' => 'id']],
            [['specialization'], 'exist', 'skipOnError' => true, 'targetClass' => Specializations::className(), 'targetAttribute' => ['specialization' => 'id']],
            [['specialization'], 'exist', 'skipOnError' => true, 'targetClass' => Specializations::className(), 'targetAttribute' => ['specialization' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'company_name' => 'Company Name',
            'email' => 'Email',
            'specialization' => 'Specialization',
            'webpage' => 'Webpage',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'twitter' => 'Twitter',
            'LinkedIn' => 'Linked In',
            'age_company' => 'Age Company',
            'count_company_workers' => 'Count Company Workers',
            'company_popularity' => 'Company Popularity',
            'company_description' => 'Company Description',
            'country' => 'Country',
        ];
    }

    /**
     * Gets query for [[AgeCompany]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgeCompany()
    {
        return $this->hasOne(AgeCompany::className(), ['id' => 'age_company']);
    }

    /**
     * Gets query for [[CompanyPopularity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyPopularity()
    {
        return $this->hasOne(CompanyPopularity::className(), ['id' => 'company_popularity']);
    }

    /**
     * Gets query for [[CountCompanyWorkers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountCompanyWorkers()
    {
        return $this->hasOne(CountCompanyWorkers::className(), ['id' => 'count_company_workers']);
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

    /**
     * Gets query for [[Specialization1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization1()
    {
        return $this->hasOne(Specializations::className(), ['id' => 'specialization']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
