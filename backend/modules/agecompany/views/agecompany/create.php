<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AgeCompany */

$this->title = 'Create Age Company';
$this->params['breadcrumbs'][] = ['label' => 'Age Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="age-company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
