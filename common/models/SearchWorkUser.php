<?php

namespace common\models;

use backend\models\User;

use Yii;

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
            [['firstname', 'lastname', 'patronymic', 'specialization', 'facebook', 'instagram', 'twitter', 'LinkedIn', 'country', 'description'], 'required'],
            [['specialization', 'country', 'user_id'], 'integer'],
            [['description'], 'string'],
            [['firstname', 'lastname', 'patronymic', 'facebook', 'instagram', 'twitter', 'LinkedIn'], 'string', 'max' => 255],
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
    public function getSpecialization0()
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

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
