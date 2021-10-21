<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\EmployerUsers */

$this->title = $model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Employer Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employer-users-view">

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
            'user_id',
            'company_name',
			[
				'attribute' => 'specialization',
				'value' => function ($model) {
					return $model->specializations->name;
				}
			],
            'webpage',
            'facebook',
            'instagram',
            'twitter',
            'LinkedIn',
			[
				'attribute' => 'age_company',
				'value' => function ($model) {
					return $model->ageCompany->age_name;
				}
			],
			[
				'attribute' => 'count_company_workers',
				'value' => function ($model) {
					return $model->countCompanyWorkers->count_company_workers;
				}
			],
			[
				'attribute' => 'company_popularity',
				'value' => function ($model) {
					return $model->companyPopularity->company_popularity;
				}
			],
            'company_description:html',
			[
				'attribute' => 'country',
				'value' => function ($model) {
					return $model->locality->title . ' ' . $model->locality->type;
				}
			],
        ],
    ]) ?>

</div>
