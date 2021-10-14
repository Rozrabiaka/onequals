<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog Employers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-employer-index">
    <p>
        <?= Html::a('Створити блог', ['/page/page'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'author_name',
            'page_name',
            [
                'attribute' => 'second_blog_category',
                'value' => function ($model) {
                    if (\backend\models\CreateBlog::SECOND_BLOG_CATEGORY_ADVICES == $model->second_blog_category)
                        return 'Поради';
                    else return 'Доступність';

                },
            ],

            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 8.7%'],
                'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('
                        <svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"></path>
                        </svg>
                        ', \yii\helpers\Url::to(['/page/page/update', 'id' => $model->id, 'category' => \backend\models\CreateBlog::BLOG_CATEGORY_EMPLOYER]));
                    },
                ],
            ],
        ]
    ]); ?>


</div>
