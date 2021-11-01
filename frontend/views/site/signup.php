<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = 'OnEquals - Реєстрація';
?>
<div class="site-signup">
    <div class="container">
        <div class="registration-form">
			<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="row">
                <div class="col-xl-6 top-blocks">
					<?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => "Ім'я"])->label(false) ?>
                </div>

                <div class="col-xl-6 top-blocks">
					<?= $form->field($model, 'email')->textInput(['placeholder' => "Ел. пошта або телефон"])->label(false) ?>
                </div>

                <div class="col-xl-6">
					<?= $form->field($model, 'password')->passwordInput(['placeholder' => "Пароль"])->label(false) ?>
                </div>

                <div class="col-xl-6">
					<?= $form->field($model, 'confirm_password')->passwordInput(['placeholder' => "Підтвердити пароль"])->label(false) ?>
                </div>

                <div class="col-xl-12">
                    <p>Натискаючи кнопку «Зареєструватися», ви приймаєте умови користування та умови
                        конфіденційності.</p>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
						<?= Html::submitButton('Зареєструватися', ['class' => 'button yellow-button', 'name' => 'signup-button']) ?>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="buttons-auth button button-auth-google">
                        <a href="/site/auth?authclient=google" class="google-auth">Продовжити з Google</a>
                    </div>
                </div>
            </div>
			<?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>
