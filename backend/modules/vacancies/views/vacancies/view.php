<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Vacancies */

$this->title = 'OnEquals - Вакансія ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vacancies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vacancies-view">

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
                'attribute' => 'employer_id',
                'value' => function ($model) {
                    return $model->employer->company_name;
                },
            ],
            [
                'attribute' => 'specialization',
                'value' => function ($model) {
                    return $model->specializations->name;
                },
            ],
            [
                'attribute' => 'country',
                'value' => function ($model) {
                    return $model->countryName->title . ' ' . $model->countryName->type;
                },
            ],
            'wage',
            'description:ntext',
            [
                'attribute' => 'employer_id',
                'value' => function ($model) {
                    return $model->employer->company_name;
                },
            ],
            [
                'attribute' => 'specialization',
                'value' => function ($model) {
                    return $model->specializations->name;
                },
            ],
            [
                'attribute' => 'employer_type',
                'value' => function ($model) {
                    return $model->employerType->name;
                },
            ],
        ],
    ]) ?>

</div>
