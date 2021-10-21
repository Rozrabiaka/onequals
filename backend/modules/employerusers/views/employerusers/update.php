<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EmployerUsers */

$this->title = 'Update Employer Users: ' . $model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Employer Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employer-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'specializationDropDownArray' => $specializationDropDownArray,
        'ageCompanyDropDownArray' => $ageCompanyDropDownArray,
        'countCompanyWorkersDropDownArray' => $countCompanyWorkersDropDownArray,
        'companyPopularityDropDownArray' => $companyPopularityDropDownArray,
        'countryName' => $countryName
    ]) ?>

</div>
