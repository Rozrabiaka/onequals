<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OnEquals - Тип зайнятості';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employment-type-index">

    <h1>Тип зайнятості</h1>

    <p>
        <?= Html::a('Створити тип зайнятості', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
