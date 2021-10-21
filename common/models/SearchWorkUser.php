<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "search_work_user".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $patronymic
 * @property int $specialization
 * @property string $facebook
 * @property string $instagram
 * @property string $twitter
 * @property string $LinkedIn
 * @property int $country
 * @property string $description
 * @property int|null $user_id
 *
 * @property Specializations $specialization0
 * @property User $user
 * @property User $user0
 */
class SearchWorkUser extends \yii\db\ActiveRecord
{

    const SEARCH_WORK_USER = 2;

    const HIDE_WORK_USER = 1;
    const SHOW_WORK_USER = 0;

    public $searchName;

    public $hiddenCountry;

    public $image;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'search_work_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'patronymic', 'specialization', 'description'], 'required'],
            [['specialization', 'user_id'], 'integer'],
            [['description', 'img'], 'string'],
            ['country', 'safe'],
            [['firstname', 'lastname', 'patronymic', 'facebook', 'instagram', 'twitter', 'LinkedIn', 'webpage'], 'string', 'max' => 255],
            [['specialization'], 'exist', 'skipOnError' => true, 'targetClass' => Specializations::className(), 'targetAttribute' => ['specialization' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'patronymic' => 'Patronymic',
            'specialization' => 'Specialization',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'twitter' => 'Twitter',
            'LinkedIn' => 'Linked In',
            'country' => 'Country',
            'description' => 'Description',
            'user_id' => 'User ID',
        ];
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }

    public function getWorkerImages()
    {
        return $this->hasMany(self::className(), ['id' => 'id']);
    }

    public function getImagesLinks()
    {
        return ArrayHelper::getColumn($this->workerImages, 'img');
    }

    public function getImagesLinksData()
    {
        return ArrayHelper::toArray($this->workerImages, [
            SearchWorkUser::className() => [
                'key' => 'id'
            ]
        ]);
    }
}
