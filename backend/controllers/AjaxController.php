<?php

namespace backend\controllers;

use common\models\History;
use common\models\Slider;
use yii\web\Controller;
use Yii;

class AjaxController extends Controller
{
    public function actionDeleteProductImage()
    {

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id = $data['key'];

            $model = new Slider();
            $result = $model::find()->where(['id' => $id])->one();

            if (file_exists(Yii::getAlias('@frontend') . '/web' . $result->img_path)) {
                unlink(Yii::getAlias('@frontend') . '/web' . $result->img_path);
            }

            $result->img_path = '';
            $result->save();

            return true;
        }

        return false;
    }

    public function actionDeleteHistoryImage()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id = $data['key'];

            $result = History::find()->where(['id' => $id])->one();

            if (file_exists(Yii::getAlias('@frontend') . '/web' . $result->img)) {
                unlink(Yii::getAlias('@frontend') . '/web' . $result->img);
            }

            $result->img = '';
            $result->save();

            return true;
        }

        return false;
    }
}