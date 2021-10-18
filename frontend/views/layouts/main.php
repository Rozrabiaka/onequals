<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <div class="header-logo">
            <a href="<?php echo Url::home(); ?>"><img src="/images/logo.png"></a>
        </div>
        <div class="header-logo-small">
            <a href="<?php echo Url::home(); ?>"><img src="/images/logo2.png"></a>
        </div>
        <div class="header-panel">
            <div class="header-info-panel">
                <?php
                if (!empty(Yii::$app->user->identity)): ?>
                    <?php if (Yii::$app->user->identity->which_user == 1): ?>
                        <a href="/site/employer-profile">Профіль</a>
                    <?php elseif (Yii::$app->user->identity->which_user == 2): ?>
                        <a href="/site/worker-profile">Профіль</a>
                    <?php else: ?>
                        <a href="/site/choose">Профіль</a>
                    <?php endif; ?>

                    <?php
                    echo Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                        . Html::submitButton(
                            'Вийти',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm();
                    ?>

                <?php else: ?>
                    <a href="/site/signup" class="register-button">Зареєструватися</a>
                    <a href="/site/login" class="login-button">Увійти</a>
                <?php endif ?>
            </div>
            <div class="header-nav">
                <a href="#"><img src="/images/nav.png"/></a>
            </div>
        </div>

        <div class="modalMenu">
            <div class="container">
                <div class="row">
                    <div class="close-model col-xl-12">
                        <span class="close-model-menu">✕</span>
                    </div>

                    <div class="col-sm-6 mobile-menu-blocks">
                        <a class="size-mobile-header" href="/site/about">Про нас</a>
                    </div>
                    <div class="col-sm-6 mobile-menu-blocks">
                        <p class="size-mobile-header">Журнал</p>
                        <ul>
                            <li><a href="/blog/summary">Шукачам</a></li>
                            <li><a href="/blog/employer">Роботодавцям</a></li>
                            <li><a href="/blog/legislation">Законодавство</a></li>
                            <?php if (!empty(Yii::$app->user->identity)): ?>
                                <li><?php
                                    echo Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                                        . Html::submitButton(
                                            'Вийти',
                                            ['class' => 'btn btn-link logout']
                                        )
                                        . Html::endForm();
                                    ?></li>
                            <?php else: ?>
                                <li><a href="/site/signup">Зареєструватися</a></li>
                                <li><a href="/site/login">Увійти</a></li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main role="main" class="flex-shrink-0">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </main>

    <footer class="footer">
        <ul class="links-footer">
            <li><a href="https://www.facebook.com/onequals/" target="_blank">Facebook</a></li>
            <li><a href="https://www.instagram.com/onequals_ua/" target="_blank">Instagram</a></li>
            <li><a href="mailto:on.equal.project@gmail.com" target="_blank">Email</a></li>
        </ul>
        <div class="ukf">
            <div class="footer-left">
                <div class="footer-left-img">
                    <img src="/images/ukf.png"/>
                </div>
                <div class="footer-left-text">
                    <p>За підтримки Українського культурного фонду</p>
                </div>
            </div>
        </div>
        <div class="footer-scroll"><a href="#w0" class="button yellow-button footer-button-scroll">на початок ↑ </a>
        </div>

        <div  class="footer-pp">
            <a href="/site/terms-of-use">Умови користування</a>
            <a href="/site/privacy-policy">Умови конфіденційності</a>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
