<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BlogSummary */

$this->title = $model->page_name;
$this->params['breadcrumbs'][] = ['label' => 'Blog Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="blog-summary-view">

    <h1><?= Html::encode($model->page_name) ?></h1>

    <p>
        <?= Html::a('Update', ['/page/page/update', 'id' => $model->id, 'category' => $model->blog_category], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'description:html',
            'author_name',
            'page_name',
            [
                'attribute' => 'blog_category',
                'value' => function () {return 'Шукачам';},
            ],
            [
                'attribute' => 'second_blog_category',
                'value' => function ($model) {
                    if (\backend\models\CreateBlog::SECOND_BLOG_CATEGORY_ADVICES == $model->second_blog_category)
                        return 'Поради';
                    else return 'Доступність';

                },
            ],
        ],
    ]) ?>

</div>