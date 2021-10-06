<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image[]')->widget(FileInput::classname(), [
        'pluginOptions' => [
            'showUpload' => false,
            'overwriteInitial' => true,
            'allowedFileExtensions' => ['jpg', 'png', 'jpeg'],
            'maxFileSize' => 2800
        ],
        'options' => ['multiple' => true, 'accept' => 'image/*'],
    ]); ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
