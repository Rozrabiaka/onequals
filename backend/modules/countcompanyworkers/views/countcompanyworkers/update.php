<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CountCompanyWorkers */

$this->title = 'Update Count Company Workers: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Count Company Workers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="count-company-workers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
