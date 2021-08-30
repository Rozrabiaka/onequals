<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SearchWorkUser */

$this->title = 'Create Search Work User';
$this->params['breadcrumbs'][] = ['label' => 'Search Work Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-work-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
