<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employer Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employer-users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Employer Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'company_name',
            'email:email',
            'specialization',
            //'webpage',
            //'facebook',
            //'instagram',
            //'twitter',
            //'LinkedIn',
            //'age_company',
            //'count_company_workers',
            //'company_popularity',
            //'company_description:ntext',
            //'country',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
