<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Vacancies */

$this->title = 'Update Vacancies: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vacancies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vacancies-update">

    <h1>Обновить вакансию</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
