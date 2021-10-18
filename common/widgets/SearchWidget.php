<?php

namespace common\widgets;

use common\models\Slider;
use common\models\Specializations;
use frontend\models\SearchForm;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use Yii;

class SearchWidget extends Widget
{
    public function run()
    {
        $searchModel = new SearchForm();
        $specializations = Specializations::find()->asArray()->all();
        $slider = Slider::find()->asArray()->all();
        $specializationDropDownArray = ArrayHelper::map($specializations, 'id', 'name');

        \Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-ui.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
        \Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/autocomplete-0.3.0.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
        \Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/autocomplete/searchLocation.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);

        return $this->render('searchWidget', [
            'searchModel' => $searchModel,
            'specializationDropDownArray' => $specializationDropDownArray,
            'slider' => $slider,
        ]);
    }
}