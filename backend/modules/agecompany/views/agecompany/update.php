<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AgeCompany */

$this->title = 'OnEquals - Оновити рік компанії: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Age Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="age-company-update">

    <h1>Оновити рік для: <?php echo $model->age_name; ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
