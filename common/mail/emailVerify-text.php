<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
?>
Доброго дня,  <?= $user->username ?>!

Будь ласка, перейдіть за посиланням, щоб підтвердити вашу електорону адресу:

<?= $verifyLink ?>
