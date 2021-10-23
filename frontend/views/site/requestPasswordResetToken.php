<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'OnEquals - Відновлення паролю';
?>
<div class="site-request-password-reset">
    <div class = "container">
    <div class="row justify-content-center request-page-header">
        <div class="col-lg-5">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Будь ласка, введіть вашу електроний адрес. Посилання на відновлення паролю буде надіслано за вказананим адресом.</p>


            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Надіслати', ['class' => 'button yellow-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>
</div>
