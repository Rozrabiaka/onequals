<?php

namespace frontend\controllers;

use common\models\Blog;
use Yii;
use common\models\History;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Site controller
 */
class BlogController extends Controller
{
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
        $modelHistory = History::find()->orderBy(['id' => SORT_DESC])->limit(10)->all();

        $dataProviderSummaryAdvices = $this->findDataProvider(Blog::SECOND_BLOG_CATEGORY_ADVICES, Blog::BLOG_CATEGORY_SUMMARY, 'page-blog-summary-advices');
        $dataProviderSummaryAccessibility = $this->findDataProvider(Blog::SECOND_BLOG_CATEGORY_ACCESSIBILITY, Blog::BLOG_CATEGORY_SUMMARY, 'page-blog-summary-accessibility');

        \Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/slider/swiper.min.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
        \Yii::$app->getView()->registerJsFile(Yii::$app->request->baseUrl . '/js/slider/slider.js', ['position' => \yii\web\View::POS_END, 'depends' => [\yii\web\JqueryAsset::className()]]);
        \Yii::$app->getView()->registerCssFile(Yii::$app->request->baseUrl . '/css/swiper.css', ['position' => \yii\web\View::POS_END]);

        return $this->render('summary', array(
            'modelHistory' => $modelHistory,
            'dataProviderSummaryAdvices' => $dataProviderSummaryAdvices,
            'dataProviderSummaryAccessibility' => $dataProviderSummaryAccessibility,
        ));
    }

    public function actionEmployer()
    {
        $dataProviderSummaryAdvices = $this->findDataProvider(Blog::SECOND_BLOG_CATEGORY_ADVICES, Blog::BLOG_CATEGORY_EMPLOYER, 'page-blog-employer-advices');
        $dataProviderSummaryAccessibility = $this->findDataProvider(Blog::SECOND_BLOG_CATEGORY_ACCESSIBILITY, Blog::BLOG_CATEGORY_SUMMARY, 'page-blog-employer-accessibility');

        return $this->render('employer', array(
            'dataProviderSummaryAdvices' => $dataProviderSummaryAdvices,
            'dataProviderSummaryAccessibility' => $dataProviderSummaryAccessibility,
        ));
    }

    public function actionLegislation()
    {
        $dataProviderSummaryAdvices = $this->findDataProvider(Blog::SECOND_BLOG_CATEGORY_ADVICES, Blog::BLOG_CATEGORY_LEGISLATION, 'page-blog-legislation-advices');
        $dataProviderSummaryAccessibility = $this->findDataProvider(Blog::SECOND_BLOG_CATEGORY_ACCESSIBILITY, Blog::BLOG_CATEGORY_LEGISLATION, 'page-blog-legislation-accessibility');

        return $this->render('legislation', array(
            'dataProviderSummaryAdvices' => $dataProviderSummaryAdvices,
            'dataProviderSummaryAccessibility' => $dataProviderSummaryAccessibility,
        ));
    }

    public function actionPage($id)
    {
        $model = Blog::findOne($id);
        if (!empty($model)) {
            $nextPageUrl = $model->getNextBlogUrl($id);
            $prevPageUrl = $model->getPrevBlogUrl($id);
            $readMoreBlogs = $model->getReadMoreBlogs($id);
            $categoryName = $model->getCategoryName($model->blog_category);

            return $this->render('page', [
                'model' => $model,
                'categoryName' => $categoryName,
                'nextPageUrl' => $nextPageUrl,
                'prevPageUrl' => $prevPageUrl,
                'readMoreBlogs' => $readMoreBlogs,
            ]);
        }

        return $this->redirect('/site/error');
    }

    public function findDataProvider($secondBlogCategory, $blogCategory, $pageParam = 'page-pagination', $pageSize = 6)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Blog::find()->where(['second_blog_category' => $secondBlogCategory])->andWhere(['blog_category' => $blogCategory]),
            'pagination' => [
                'pageParam' => $pageParam,
                'pageSize' => $pageSize
            ]
        ]);

        return $dataProvider;
    }

}
