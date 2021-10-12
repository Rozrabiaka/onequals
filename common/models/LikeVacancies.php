<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "like_vacancies".
 *
 * @property int $id
 * @property int $vacancies_id
 * @property int|null $user_id
 *
 * @property User $user
 * @property Vacancies $vacancies
 */
class LikeVacancies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'like_vacancies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vacancies_id'], 'required'],
            [['vacancies_id', 'user_id'], 'integer'],
            [['vacancies_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vacancies::className(), 'targetAttribute' => ['vacancies_id' => 'id']],
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
            'vacancies_id' => 'Vacancies ID',
            'user_id' => 'User ID',
        ];
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
     * Gets query for [[Vacancies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVacancies()
    {
        return $this->hasOne(Vacancies::className(), ['id' => 'vacancies_id']);
    }

    public function getLikeVacanciesArrayByLoginUserId()
    {
        $likeModel = self::find()->select(['id', 'vacancies_id'])->where(['user_id' => Yii::$app->user->identity->id])->asArray()->all();
        $likeModelArray = ArrayHelper::map($likeModel, 'id', 'vacancies_id');

        return $likeModelArray;
    }
}
