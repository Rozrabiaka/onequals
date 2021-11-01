<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = 'OnEquals - Вхід';
?>
<div class="site-login">
    <div class="container">
        <div class="login-form">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="row">
                <div class="col-xl-12">
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Ел. пошта'])->label(false) ?>
                </div>

                <div class="col-xl-12">
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>
                </div>

                <div class="col-xl-12">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>

                <div class='col-xl-12' style="color:#566BA4;margin:1em 0">
                    <?= Html::a('Забули пароль?', ['site/request-password-reset']) ?>.
                    <br>
                    <?= Html::a('Потрібно підтвердити почту?', ['site/resend-verification-email']) ?>
                </div>

                <div class="col-xl-6">
                    <div class="form-group">
                        <?= Html::submitButton('Увійти →', ['class' => 'button yellow-button', 'name' => 'signup-button']) ?>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="buttons-auth button button-auth-google">
                        <a href="/site/auth?authclient=google" class="google-auth">Продовжити з Google</a>
                    </div>
                    <div class="buttons-auth button button-auth-facebook">
                        <a href="/site/auth?authclient=facebook" class="facebook-auth">Продовжити з FB</a>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
