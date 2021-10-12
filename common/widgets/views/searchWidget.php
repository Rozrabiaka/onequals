<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="home-search-block">
    <div class="search">
        <?php
        $form = ActiveForm::begin([
            'id' => 'search-form',
            'action' => ['site/search'],
            'method' => 'get'
        ]) ?>
        <div class="col-xl-4">
            <?= $form->field($searchModel, 'search')->textInput(['placeholder' => 'Ключові слова', 'value' => Yii::$app->request->queryParams['SearchForm']['search']])->label(false) ?>
        </div>

        <div class="col-xl-4">
            <?= $form->field($searchModel, 'specialization')->dropDownList($specializationDropDownArray, [
                'prompt' => 'Спеціалізації',
                'value' => Yii::$app->request->queryParams['SearchForm']['specialization']
            ])->label(false) ?>
        </div>

        <div class="col-xl-4 search-input">
            <?= $form->field($searchModel, 'city')->textInput(['placeholder' => 'Введіть місто (наприклад Київ)', 'class' => 'search-location', 'value' => Yii::$app->request->queryParams['SearchForm']['city']])->label(false) ?>
        </div>

        <?= $form->field($searchModel, 'hiddenCountry')->hiddenInput(['class' => 'country-js-hidden-id', 'value' => $model->country])->label(false) ?>
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
