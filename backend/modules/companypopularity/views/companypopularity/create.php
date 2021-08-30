<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyPopularity */

$this->title = 'Create Company Popularity';
$this->params['breadcrumbs'][] = ['label' => 'Company Popularities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-popularity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
