<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompanyPopularity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-popularity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_popularity')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
