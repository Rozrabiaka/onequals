<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyPopularity */

$this->title = 'OnEquals - Оновити компанію: ' . $model->company_popularity;
$this->params['breadcrumbs'][] = ['label' => 'Company Popularities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-popularity-update">

    <h1>Оновити популярність: <?php echo $model->company_popularity; ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
