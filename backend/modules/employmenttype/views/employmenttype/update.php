<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EmploymentType */

$this->title = 'OnEquals -  Оновити тип зайнятості: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employment-type-update">

    <h1>Оновити тип зайнятості: <?php echo $model->name; ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
