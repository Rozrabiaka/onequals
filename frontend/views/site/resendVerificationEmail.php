<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Відправити підтверджуючий лист';
?>
<div class="site-resend-verification-email">
    <div class = "container">
        <div class="row justify-content-center request-page-header">
            <div class="col-lg-5">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Будь ласка, введіть вашу електроний адрес. Підтверджуючий лист буде надіслано за вказананим адресом.</p>


                <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Надіслати', ['class' => 'button yellow-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
