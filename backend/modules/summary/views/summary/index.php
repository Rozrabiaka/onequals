<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Summaries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="summary-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			[
				'attribute' => 'worker_id',
				'value' => function ($model) {
					return $model->worker->firstname . ' ' . $model->worker->lastname;
				}
			],
			[
				'attribute' => 'specialization',
				'value' => function ($model) {
					return $model->specializations->name;
				}
			],
			[
				'attribute' => 'country',
				'value' => function ($model) {
					return $model->locality->title . ' ' . $model->locality->type;
				}
			],
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
</div>
