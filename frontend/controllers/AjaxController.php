<?php

namespace frontend\controllers;

use common\models\Locality;
use yii\web\Controller;
use Yii;
use yii\helpers\Json;

class AjaxController extends Controller
{
    public function actionLocality()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->get();
            $s = trim($data['keyword']);

            $locality = Locality::find()->select(['locality.id','locality.title as loctitle', 'locality.type as loctype', 'l1.title', 'l1.type'])
                ->leftJoin(['l1' => 'locality_con'], 'locality.parent_id = l1.id')
                ->where(['like', 'locality.title', $s])
                ->asArray()
                ->all();

            if (!empty($locality)) {
                return JSON::encode($locality);
            }
        }

        return JSON::encode(null);
    }
}