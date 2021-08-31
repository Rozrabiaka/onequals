<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Popularities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-popularity-index">

    <h1>Популярність компанії</h1>

    <p>
        <?= Html::a('Створити популярність', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_popularity',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
