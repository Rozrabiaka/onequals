<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

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
	const EMPLOYER_WHICH_USER = 1;
	const HIDE_EMPLOYER = 1;
	const SHOW_EMPLOYER = 0;

	public $hiddenCountry;

	public $image;

	/**
	 *
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
			[['user_id', 'company_name', 'specialization', 'age_company', 'count_company_workers', 'company_popularity', 'company_description'], 'required'],
			[['user_id', 'specialization', 'age_company', 'count_company_workers', 'company_popularity', 'hide_employer'], 'integer'],
			[['company_description', 'img'], 'string'],
			[['contact_email'], 'email'],
			['country', 'safe'],
			[['company_name', 'webpage', 'facebook', 'instagram', 'twitter', 'LinkedIn'], 'string', 'max' => 255],
			[['age_company'], 'exist', 'skipOnError' => true, 'targetClass' => AgeCompany::className(), 'targetAttribute' => ['age_company' => 'id']],
			[['company_popularity'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyPopularity::className(), 'targetAttribute' => ['company_popularity' => 'id']],
			[['count_company_workers'], 'exist', 'skipOnError' => true, 'targetClass' => CountCompanyWorkers::className(), 'targetAttribute' => ['count_company_workers' => 'id']],
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

	public function getLocality()
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

	/**
	 * Gets query for [[User]].
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	public function getEmployerImages()
	{
		return $this->hasMany(self::className(), ['id' => 'id']);
	}

	public function getImagesLinks()
	{
		return ArrayHelper::getColumn($this->employerImages, 'img');
	}

	public function getImagesLinksData()
	{
		return ArrayHelper::toArray($this->employerImages, [
			EmployerUsers::className() => [
				'key' => 'id'
			]
		]);
	}
}
