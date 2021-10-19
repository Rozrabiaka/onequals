<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vacancies */

$this->title = 'OnEquals - Оновити вакансію';
$this->params['breadcrumbs'][] = ['label' => 'Vacancies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vacancies-update">

    <h1>Оновити вакансію</h1>

    <?= $this->render('_form', [
        'model' => $model,
        'specializationDropDownArray' => $specializationDropDownArray,
        'employmentTypeDropDownArray' => $employmentTypeDropDownArray,
        'countryName' => $countryName
    ]) ?>

</div>
