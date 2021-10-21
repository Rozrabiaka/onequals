<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EmployerUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employer-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'specialization')->dropDownList($specializationDropDownArray) ?>

    <?= $form->field($model, 'webpage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LinkedIn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age_company')->dropDownList($ageCompanyDropDownArray) ?>

    <?= $form->field($model, 'count_company_workers')->dropDownList($countCompanyWorkersDropDownArray) ?>

    <?= $form->field($model, 'company_popularity')->dropDownList($companyPopularityDropDownArray) ?>

    <?= $form->field($model, 'company_description')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'country')->textInput(['placeholder' => 'Введіть місто (наприклад Київ)', 'class' => 'form-control search-location', 'value' => $countryName]); ?>

	<?= $form->field($model, 'hiddenCountry')->hiddenInput(['class' => 'country-js-hidden-id', 'value' => $model->country])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
