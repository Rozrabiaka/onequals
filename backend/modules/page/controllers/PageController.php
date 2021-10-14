<?php

namespace backend\modules\page\controllers;

use backend\models\CreateBlog;
use common\models\BlogEmployer;
use common\models\BlogLegislation;
use common\models\BlogSummary;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `page` module
 */
class PageController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $createBlog = new CreateBlog();

        if (!empty(Yii::$app->request->post())) {
            $blogCategory = Yii::$app->request->post('CreateBlog')['blog_category'];

            switch ($blogCategory) {
                case $createBlog::BLOG_CATEGORY_SUMMARY:
                    $model = new BlogSummary();
                    $view = '/blogsummary/blogsummar/view';
                    break;
                case $createBlog::BLOG_CATEGORY_EMPLOYER:
                    $model = new BlogEmployer();
                    $view = '/blogemployer/blogemployer/view';
                    break;
                case $createBlog::BLOG_CATEGORY_LEGISLATION:
                    $model = new BlogLegislation();
                    $view = '/bloglegislation/bloglegislation/view';
                    break;
            }

            $model->description = Yii::$app->request->post('CreateBlog')['description'];
            $model->author_name = Yii::$app->request->post('CreateBlog')['author_name'];
            $model->page_name = Yii::$app->request->post('CreateBlog')['page_name'];
            $model->blog_category = Yii::$app->request->post('CreateBlog')['blog_category'];
            $model->second_blog_category = Yii::$app->request->post('CreateBlog')['second_blog_category'];

            if ($model->save()) {
                $this->redirect('/admin' . $view . '?id=' . $model->getPrimaryKey());
            } else {
                Yii::$app->session->setFlash('error', "Помилка при створені сторінки. Будь ласка спробуйте знову.");
            }
        }

        return $this->render('index', [
            'model' => $createBlog
        ]);
    }

    public function actionUpdate($id, $category)
    {
        switch ($category) {
            case CreateBlog::BLOG_CATEGORY_SUMMARY:
                $model = new BlogSummary();
                $view = '/blogsummary/blogsummar/view';
                break;
            case CreateBlog::BLOG_CATEGORY_EMPLOYER:
                $model = new BlogEmployer();
                $view = '/blogemployer/blogemployer/view';
                break;
            case CreateBlog::BLOG_CATEGORY_LEGISLATION:
                $model = new BlogLegislation();
                $view = '/bloglegislation/bloglegislation/view';
                break;
        }

        $createBlogModel = new CreateBlog();
        $updateModel = $model::find()->where(['id' => $id])->one();

        if (!empty(Yii::$app->request->post())) {
            $updateModel->load(Yii::$app->request->post());

            if ($updateModel->save()) {
                $this->redirect('/admin' . $view . '?id=' . $id);
            } else {
                Yii::$app->session->setFlash('error', "Помилка при оновлені блогу. Будь ласка спробуйте знову.");
            }

        }

        return $this->render('update', [
            'createBlogModel' => $createBlogModel,
            'model' => $updateModel
        ]);
    }
}
