<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Summary */

$this->title = 'Create Summary';
$this->params['breadcrumbs'][] = ['label' => 'Summaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="summary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
