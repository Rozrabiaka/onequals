<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Blog */

$this->title = 'OnEquals' . $model->page_name;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="blog-view">

    <h1>Кар’єра / Резюме : <?= Html::encode($model->page_name) ?></h1>

    <p>
        <?= Html::a('Оновити', ['/page/page/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалити', ['delete', 'id' => $model->id], [
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
            'date',

        ],
    ]) ?>

</div>
