<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Specializations */

$this->title = 'Create Specializations';
$this->params['breadcrumbs'][] = ['label' => 'Specializations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specializations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
