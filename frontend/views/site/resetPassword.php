<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'OnEquals - Скинути пароль';
?>
<div class="site-reset-password">
    <div class="container">
        <div class="row justify-content-center request-page-header">
            <div class="col-lg-5">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Будь ласка, введіть ваш новий пароль:</p>

				<?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

				<?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label('Новий пароль'); ?>

                <div class="form-group">
					<?= Html::submitButton('Відновити', ['class' => 'button yellow-button']) ?>
                </div>

				<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
