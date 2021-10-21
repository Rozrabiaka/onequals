<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Summary */

$this->title = 'OnEquals - вакансія користувача: ' . $model->worker->firstname . ' ' . $model->worker->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="summary-view">

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
            'description:html',
			[
				'attribute' => 'employer_type',
				'value' => function ($model) {
					return $model->employerType->name;
				}
			],
            'wage',
            'date',
        ],
    ]) ?>

</div>
