<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CountCompanyWorkers */

$this->title = 'Create Count Company Workers';
$this->params['breadcrumbs'][] = ['label' => 'Count Company Workers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="count-company-workers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
