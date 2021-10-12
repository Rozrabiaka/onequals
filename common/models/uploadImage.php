<?php
namespace common\models;

use yii\base\Model;
use Yii;

class UploadImage extends Model
{
    public function uploadImage($image)
    {
        $uploadPath = Yii::getAlias('@uploads') . '/images/' . date('Y') . '/' . date('m');
        $path = Yii::getAlias('@frontend') . '/web' . $uploadPath;
        if (!is_dir($path))
            mkdir($path, 0777, true);

        foreach ($image as $file) {
            $fileName = md5(microtime() . rand(0, 9999)) . '_' . $file->name;
            $imagePath = $path . '/' . $fileName;

            if ($file->saveAs($imagePath))
                return $uploadPath . '/' . $fileName;
        }

        return false;
    }
}
?>