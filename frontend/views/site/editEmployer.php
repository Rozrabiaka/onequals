<?php

use dosamigos\ckeditor\CKEditor;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use kartik\file\FileInput;
use yii\helpers\Url;

$this->title = 'OnEquals - Редагувати вакансію';
?>

<div class="site-edit-employer">
    <div class="container">
        <div class="choose-form">
            <h1>Оновити Інформацію</h1>

            <?php $form = ActiveForm::begin(['id' => 'edit-employer-form']); ?>
            <div class="row">
                <div class="col-xl-3 profile-avatar">
                    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
                        'language' => 'ru',
                        'pluginOptions' => [
                            'initialPreview' => $model->imagesLinks,
                            'initialPreviewConfig' => $model->imagesLinksData,
                            'deleteUrl' => Url::toRoute(['/ajax/delete-employer-avatar-image']),
                            'browseOnZoneClick' => true,
                            'showCaption' => false,
                            'showRemove' => false,
                            'showCancel' => false,
                            'showBrowse' => false,
                            'initialPreviewAsData' => true,
                            'showUpload' => false,
                            'overwriteInitial' => false,
                            'allowedFileExtensions' => ['jpg', 'png', 'jpeg'],
                            'maxFileSize' => 2800,
                        ],
                        'options' => ['accept' => 'image/*'],
                    ])->label(false); ?>
                </div>

                <div class="col-xl-12">
                    <?= $form->field($model, 'company_name')->textInput(['autofocus' => true, 'placeholder' => 'наприклад, магазин "Сонечко" '])->label('1. Назва компанії / організації / ФОП') ?>
                </div>

                <div class="col-xl-12">
                    <?= $form->field($model, 'specialization')->dropDownList($specializationDropDownArray, [
                        'prompt' => 'Спеціалізації'
                    ])->label('2. Оберіть, в якій сфері ви працюєте') ?>
                </div>

                <div class="col-xl-12 search-input">
                    <?= $form->field($model, 'country')->textInput(['placeholder' => 'Введіть місто (наприклад Київ)', 'class' => 'form-control search-location', 'value' => $countryName])->label('3. Ваше розташування') ?>
                </div>

                <?= $form->field($model, 'hiddenCountry')->hiddenInput(['class' => 'country-js-hidden-id', 'value' => $model->country])->label(false) ?>
                <div class="col-xl-12">
                    <?= $form->field($model, 'webpage')->textInput(['placeholder' => 'вставте лінк'])->label('4. Ваш сайт, якщо він є') ?>
                </div>


                <div class="col-xl-12">
					<?= $form->field($model, 'contact_email')->textInput(['placeholder' => 'example@example.com'])->label("5. Пошта для зв'язку") ?>
                </div>

                <div class="col-xl-12 social-link-employer">
                    <label>6. Соціальні мережі</label>
                    <div class="col-xl-12 col-padding-zero">
                        <?= $form->field($model, 'facebook')->textInput(['placeholder' => 'вставте лінк'])->label('Facebook') ?>
                    </div>

                    <div class="col-xl-12 col-padding-zero">
                        <?= $form->field($model, 'instagram')->textInput(['placeholder' => 'вставте лінк'])->label('Instagram') ?>
                    </div>

                    <div class="col-xl-12 col-padding-zero">
                        <?= $form->field($model, 'twitter')->textInput(['placeholder' => 'вставте лінк'])->label('Twitter') ?>
                    </div>

                    <div class="col-xl-12 col-padding-zero">
                        <?= $form->field($model, 'LinkedIn')->textInput(['placeholder' => 'вставте лінк'])->label('LinkedIn') ?>
                    </div>
                </div>

                <label>7. Оберіть варіант, який вам підходить </label>

                <div class="col-xl-4 col-padding-zero border-block">
                    <div class="company-info-employer">
                        <?= $form->field($model, 'age_company')->radioList($listAge)->label('1. Скільки років компанії?'); ?>
                    </div>
                </div>

                <div class="col-xl-4 col-padding-zero border-block">
                    <div class="company-info-employer">
                        <?= $form->field($model, 'count_company_workers')->radioList($listCountCompany)->label('2. Скільки працівників у вашій команді?'); ?>
                    </div>
                </div>

                <div class="col-xl-4 col-padding-zero border-block">
                    <div class="company-info-employer">
                        <?= $form->field($model, 'company_popularity')->radioList($listCompanyPopularity)->label('2. Скільки працівників у вашій команді?'); ?>
                    </div>
                </div>

                <div class="col-xl-12 ">
                    <?= $form->field($model, 'company_description')->widget(CKEditor::className(), [
						'options' => ['rows' => 8],
						'clientOptions' => [
							'toolbar' => true,
							'removePlugins' => 'image','format','styles'
						],

					])->label('8. Розкажіть про себе більше (про умови праці у вашій команді, про ваші цінності, про сприятливі умови для людей з інвалідністю)') ?>
                </div>

                <div class="col-xl-6 save-profile-block">
                    <div class="form-group">
                        <?= Html::submitButton('Зберегти і далі! ', ['class' => 'button save-profile-button', 'name' => 'signup-button']) ?>
                    </div>
                </div>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
