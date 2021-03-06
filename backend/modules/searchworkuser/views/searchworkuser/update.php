<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SearchWorkUser */

$this->title = 'Update Search Work User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Search Work Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="search-work-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'specializationDropDownArray' => $specializationDropDownArray,
        'countryName' => $countryName
    ]) ?>

</div>
