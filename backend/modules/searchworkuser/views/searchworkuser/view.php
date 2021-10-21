<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SearchWorkUser */

$this->title = $model->firstname . ' ' . $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Search Work Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="search-work-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		]) ?>
    </p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'firstname',
			'lastname',
			'patronymic',
			[
				'attribute' => 'specialization',
				'value' => function ($model) {
					return $model->specializations->name;
				}
			],
			'facebook',
			'instagram',
			'twitter',
			'LinkedIn',
			[
				'attribute' => 'country',
				'value' => function ($model) {
					return $model->locality->title . ' ' . $model->locality->type;
				}
			],
			'description:ntext',
			'user_id',
		],
	]) ?>

</div>
