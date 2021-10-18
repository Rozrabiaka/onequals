<?php

namespace backend\modules\page\controllers;

use common\models\Blog;
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
        $model = new Blog();

        if (!empty(Yii::$app->request->post())) {
            if ($model->load(Yii::$app->request->post()) and $model->save()) {
                $view = $this->viewRedirect($model->blog_category);
                $this->redirect('/admin' . $view . '?id=' . $model->getPrimaryKey());
            } else {
                Yii::$app->session->setFlash('error', "Помилка при створені сторінки. Будь ласка спробуйте знову.");
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Blog::find()->where(['id' => $id])->one();

        if (!empty(Yii::$app->request->post())) {
            if ($model->load(Yii::$app->request->post()) and $model->save()) {
                $view = $this->viewRedirect($model->blog_category);
                $this->redirect('/admin' . $view . '?id=' . $id);
            } else {
                Yii::$app->session->setFlash('error', "Помилка при оновлені блогу. Будь ласка спробуйте знову.");
            }
        }

        if (!empty($model)) {
            return $this->render('update', [
                'model' => $model
            ]);
        }

        return $this->redirect('/admin/error');
    }

    protected function viewRedirect($category)
    {
        $view = null;
        switch ($category) {
            case Blog::BLOG_CATEGORY_EMPLOYER:
                $view = '/blogemployer/blogemployer/view';
                break;
            case Blog::BLOG_CATEGORY_SUMMARY:
                $view = 'blogsummary/blogsummary/view';
                break;
            case Blog::BLOG_CATEGORY_LEGISLATION:
                $view = 'bloglegislation/bloglegislation/view';
                break;
            case Blog::BLOG_CATEGORY_CAREER:
                $view = 'blogcareer/blogcareer/view';
                break;
        }

        return $view;
    }
}
