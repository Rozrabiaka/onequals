<?php

namespace common\models;

use backend\models\ProductsImage;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string $img_path
 * @property string $text
 */
class Slider extends \yii\db\ActiveRecord
{

    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
            [['img_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img_path' => 'Img Path',
            'text' => 'Text',
        ];
    }

    public function getSliderImages()
    {
        return $this->hasMany(self::className(), ['id' => 'id']);
    }

    public function getImagesLinks()
    {
        return ArrayHelper::getColumn($this->sliderImages, 'img_path');
    }

    public function getImagesLinksData()
    {
        return ArrayHelper::toArray($this->sliderImages, [
            Slider::className() => [
                'key' => 'id'
            ]
        ]);
    }

    public function uploadImage()
    {
        $uploadPath = Yii::getAlias('@uploads') . '/images/' . date('Y') . '/' . date('m');
        $path = Yii::getAlias('@frontend') . '/web' . $uploadPath;
        if (!is_dir($path))
            mkdir($path, 0777, true);

        foreach ($this->image as $file) {
            $fileName = md5(microtime() . rand(0, 9999)) . '_' . $file->name;
            $imagePath = $path . '/' . $fileName;

            if ($file->saveAs($imagePath))
                return $uploadPath . '/' . $fileName;
        }

        return false;
    }
}
