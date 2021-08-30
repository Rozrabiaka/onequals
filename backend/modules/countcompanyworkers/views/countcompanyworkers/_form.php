<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CountCompanyWorkers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="count-company-workers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'count_company_workers')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
