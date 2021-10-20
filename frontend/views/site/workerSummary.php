<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'OnEquals - Створити резюме';
?>

<div class="site-edit-employer-vacation">
    <div class="container">
        <div class="choose-form">
            <h1>Створити резюме</h1>

            <?php $form = ActiveForm::begin(['id' => 'worker-summary-form']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <?= $form->field($model, 'specialization')->dropDownList($specializationDropDownArray, [
                        'prompt' => 'Спеціалізації'
                    ])->label('1. Оберіть вакансію, яка вам потрібна') ?>
                </div>

                <div class="col-xl-12">
                    <?= $form->field($model, 'employer_type')->radioList($employmentTypeDropDownArray)->label('2. Оберіть тип зайнятості') ?>
                </div>

                <div class="col-xl-12 search-input">
                    <?= $form->field($model, 'country')->textInput(['placeholder' => 'Введіть місто (наприклад Київ)', 'class' => 'form-control search-location', 'value' => ''])->label('3. Ваше розташування') ?>
                </div>

                <?= $form->field($model, 'hiddenCountry')->hiddenInput(['class' => 'country-js-hidden-id', 'value'=> $model->country])->label(false) ?>

                <div class="col-xl-12">
                    <?= $form->field($model, 'description')->textarea(['placeholder' => 'до 1000 знаків'])->label('4. Розкажіть про вакантне місце більше (про умови праці у вашій команді, тощо)') ?>
                </div>

                <div class="col-xl-12">
                    <?= $form->field($model, 'wage')->textInput(['placeholder' => 'наприклад 15000'])->label('5. Вкажіть зарплату (у гривнях)') ?>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <?= Html::submitButton('Зберегти і далі', ['class' => 'button yellow-button', 'name' => 'signup-button']) ?>
                    </div>
                </div>


            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
