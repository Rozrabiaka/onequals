<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Count Company Workers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="count-company-workers-index">

    <h1>Кількість працівників компанії</h1>

    <p>
        <?= Html::a('Створити нову кількісь', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'count_company_workers',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
