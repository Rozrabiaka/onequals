<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Search Work Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-work-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= Html::a('Очистити фільтри', ['index'], ['class' => 'btn btn-info']) ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			[
				'attribute' => 'user_id',
				'value' => function ($model) {
					return $model->user->email;
				}
			],
			'firstname',
			'patronymic',
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
