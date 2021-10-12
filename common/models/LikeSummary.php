<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "like_summary".
 *
 * @property int $id
 * @property int $summary_id
 * @property int|null $user_id
 *
 * @property Summary $summary
 * @property User $user
 */
class LikeSummary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'like_summary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['summary_id'], 'required'],
            [['summary_id', 'user_id'], 'integer'],
            [['summary_id'], 'exist', 'skipOnError' => true, 'targetClass' => Summary::className(), 'targetAttribute' => ['summary_id' => 'id']],
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
            'summary_id' => 'Summary ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Summary]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSummary()
    {
        return $this->hasOne(Summary::className(), ['id' => 'summary_id']);
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

    public function getLikeSummaryArrayByLoginUserId()
    {
        $likeModel = self::find()->select(['id', 'summary_id'])->where(['user_id' => Yii::$app->user->identity->id])->asArray()->all();
        $likeModelArray = ArrayHelper::map($likeModel, 'id', 'summary_id');

        return $likeModelArray;
    }
}
