<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CountCompanyWorkers */

$this->title = 'OnEquals - ' . $model->count_company_workers;
$this->params['breadcrumbs'][] = ['label' => 'Count Company Workers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="count-company-workers-update">

    <h1>Оновити кількість компанії для: <?php echo $model->count_company_workers; ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
