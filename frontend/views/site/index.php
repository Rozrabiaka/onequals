<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'OnEquals';
?>

<div class="container">
    <div class="row">
        <div class="home-search-block">
            <div class="search">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'search-form',
                ]) ?>
                <div class="col-xl-4">
                    <?= $form->field($searchModel, 'search')->textInput(['placeholder' => 'Ключові слова'])->label(false) ?>
                </div>
                <div class="col-xl-4">
                    <?= $form->field($searchModel, 'specialization')->dropDownList($specializationDropDownArray, [
                        'prompt' => 'Спеціалізації'
                    ])->label(false) ?>
                </div>
                <div class="col-xl-4">
                    <?= $form->field($searchModel, 'specialization')->textInput(['placeholder' => 'Введіть місто (наприклад Київ)', 'class' => 'search-location'])->label(false) ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 search-button-block">
                    <?= Html::submitButton('Знайти', ['class' => 'button blue-button search-button']) ?>
                </div>
            </div>

            <img class="home-search-img-lightning-2" src="/images/lightning-2.png"/>
            <img class="home-search-img-lightning-1" src="/images/lightning-1.png"/>
            <img class="home-search-img-start-1" src="/images/star-1.png"/>
            <img class="home-search-img-start-2" src="/images/star-2.png"/>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
<div class="home-buttons">
    <div class="container">
        <div class="row home-buttons-main">
            <div class="col-xl-6">
                <a href="#">
                    <div class="smile-button-left">
                        <div class="smile-center-block"><img src="/images/smile-1.png"/><span>Розмістити вакансію</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6">
                <a href="#">
                    <div class="smile-button-right">
                        <div class="smile-center-block"><span>Розмістити резюме</span><img src="/images/smile-2.png"/>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="home-video">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="home-video-left-text">
                    <p>
                        Проєкт, який спрямований на збільшення статистики працевлаштування людей з інвалідністю в
                        Україні у різноманітних сферах, відповідно до професійних якостей кандидатів та кандидаток.</p>
                    <a href="/about">дізнатися більше →</a>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="home-video-about-us">
                    <iframe width="100%" height="615" src="https://www.youtube.com/embed/140KSPfCjSU"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-xl-6">
                <img class="home-video-heart" src="/images/heart.png"/>
            </div>
            <div class="col-xl-6">
                <img class="home-video-arrow-1" src="/images/arrow-1.png"/>
            </div>
        </div>
    </div>
</div>

<div class="slayder-stick">
    <div class="container">
        <div class="row">
            <div class="col-md-6 slyder-stick-download-button">
                <a href="https://t.me/addstickers/on_equals" class="button">
                    <div class="button-div"><span>Завантажити стікерпак &darr;</span></div>
                </a>

                <p>Ми створили мотиваційний стікерпак для телеграму! Завантажуй і доповнюй його новими іменами!</p>
            </div>

            <div class="col-md-12">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="col-xl-6">
                                image here
                            </div>
                            <div class="col-xl-6">
                                text here
                            </div>
                        </div>
                        <div class="swiper-slide">Slide 2</div>
                        <div class="swiper-slide">Slide 3</div>
                        <div class="swiper-slide">Slide 4</div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="home-support">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="home-support-text">
                    <p>Якщо ви хочете підтримати ініціативу «На рівних», у вас є змога підключити щомісячний донат або
                        одноразовий внесок за реквізитами на розвиток та роботу платформи або придбати унікальний мерч
                        та
                        допомогти в зборі коштів на сертифікати на навчання в різних сферах для людей з
                        інвалідністю.</p>
                </div>
            </div>

            <div class="col-xl-6 support-buttons">
                <a href="https://www.patreon.com/onequals" class="button">
                    <div class="smile-button-left">
                        <div class="smile-center-block">
                            <img src="/images/support-heart-1.png"/>
                            <span>Підключити щомісячний донат</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-6 support-buttons">
                <a href="https://send.monobank.ua/jar/2tsi1dsLLE" class="button">
                    <div class="smile-button-right">
                        <div class="smile-center-block">
                            <span>Зробити одноразовий внесок</span>
                            <img src="/images/support-heart-2.png"/>
                        </div>
                    </div>
                </a>
            </div>

            <div class="home-bottom-text">
                <p>Також ви можете долучитись до команди, ставши волонтером за такими напрямками: SMM, PR,
                    Копірайтинг, Адміністрування, свої пропозиції.</p>

                <p> Якщо у вас виникли запитання або ви хочете долучитись до команди «На рівних», пишіть нам на
                    пошту <a href="mailto:on.equal.project@gmail.com">on.equal.project@gmail.com</a> або у соціальні
                    мережі в <a href="https://www.facebook.com/onequals/">фейсбук</a> та <a
                            href="https://www.instagram.com/onequals_ua/">інстаграм</a>.</p>
            </div>
        </div>
    </div>
</div>