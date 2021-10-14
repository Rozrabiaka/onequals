<?php

namespace frontend\controllers;

use common\models\BlogSummary;
use yii\web\Controller;

/**
 * Site controller
 */
class BlogController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function actionSummary()
    {
        $model = BlogSummary::find()->all();
        return $this->render('summary');
    }

    public function actionEmployer()
    {
        return $this->render('employer');
    }

    public function actionLegislation()
    {
        return $this->render('legislation');
    }
}
