<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1>Список користувачів для модулю RBAC</h1>

	<?= Html::a('Очистити фільтри', ['index'], ['class' => 'btn btn-info']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                   return $model->getStatusActiveUserByStatusId($model->status);
                },
            ],
            [
                'attribute' => 'user_role',
                'value' => function ($model) {
                   return $model->getUserAdminStatus($model->id);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
