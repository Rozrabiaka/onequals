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

            $blogModel = $this->getBlogModel($blogCategory);
            $model = $blogModel['model'];
            $view = $blogModel['view'];

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
        $blogModel = $this->getBlogModel($category);
        $model = $blogModel['model'];
        $view = $blogModel['view'];

        $createBlogModel = new CreateBlog();
        $updateModel = $model::find()->where(['id' => $id])->one();

        $updateModel->blog_category = $category;
        if (!empty(Yii::$app->request->post())) {
            $modelName = $this->getModelClass($updateModel::className());

            //Если меняют категорию удаляем старое добавляем в новую категорию
            if (Yii::$app->request->post($modelName)['blog_category'] !== $category) {
                $model::findOne($id)->delete();

                $newBlogModel = $this->getBlogModel(Yii::$app->request->post($modelName)['blog_category']);
                $view = $newBlogModel['view'];
                $newModel = $newBlogModel['model'];

                $newModel->description = Yii::$app->request->post($modelName)['description'];
                $newModel->author_name = Yii::$app->request->post($modelName)['author_name'];
                $newModel->page_name = Yii::$app->request->post($modelName)['page_name'];
                $newModel->second_blog_category = Yii::$app->request->post($modelName)['second_blog_category'];

                if ($newModel->save()) {
                    $this->redirect('/admin' . $view . '?id=' . $newModel->getPrimaryKey());
                } else {
                    Yii::$app->session->setFlash('error', "Помилка при оновлені блогу. Будь ласка спробуйте знову.");
                }
            } else {
                //обновляем существующую
                $updateModel->load(Yii::$app->request->post());
                if ($updateModel->save()) {
                    $this->redirect('/admin' . $view . '?id=' . $id);
                } else {
                    Yii::$app->session->setFlash('error', "Помилка при оновлені блогу. Будь ласка спробуйте знову.");
                }
            }
        }

        return $this->render('update', [
            'createBlogModel' => $createBlogModel,
            'model' => $updateModel
        ]);
    }

    protected function getBlogModel($id)
    {
        switch ($id) {
            case CreateBlog::BLOG_CATEGORY_SUMMARY:
                $model = new BlogSummary();
                $view = '/blogsummary/blogsummary/view';
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

        return array(
            'model' => $model,
            'view' => $view
        );
    }

    protected function getModelClass($className)
    {
        $explode = explode("\\", $className);
        return end($explode);
    }
}
