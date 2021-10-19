<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OnEquals - Роботодавці';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employer-users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'search_company_name',
                'value' => function ($model) {
                    return $model->company_name;
                },
            ],
            [
                'attribute' => 'email',
                'value' => function ($model) {
                    return $model->user->email;
                },
            ],
            [
                'attribute' => 'specialization',
                'value' => function ($model) {
                    return $model->specializations->name;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
