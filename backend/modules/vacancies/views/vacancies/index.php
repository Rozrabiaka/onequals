<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vacancies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancies-index">

    <h1>Вакансії</h1>

    <p>
        <?= Html::a('Створити вакансію', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'employer_id',
            'specialization',
            'country',
            'wage',
            //'description:ntext',
            //'employer_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
