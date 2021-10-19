<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OnEquals -> Вакансії';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancies-index">

    <h1>Вакансії</h1>

    <?= Html::a('Очистити фільтри', ['index'], ['class' => 'btn btn-info']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'employer_id',
                'value' => function ($model) {
                    return $model->employer->company_name;
                },
            ],
            [
                'attribute' => 'specialization',
                'value' => function ($model) {
                    return $model->specializations->name;
                },
            ],
            [
                'attribute' => 'country',
                'value' => function ($model) {
                    return $model->countryName->title . ' ' . $model->countryName->type;
                },
            ],
            'wage',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
