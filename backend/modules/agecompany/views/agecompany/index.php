<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Age Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="age-company-index">

    <h1>Роки компанії</h1>

    <p>
        <?= Html::a('Створити рік компанії', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'age_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
