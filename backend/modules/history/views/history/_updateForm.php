<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\History */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'pluginOptions' => [
            'initialPreview' => $model->imagesLinks,
            'initialPreviewConfig' => $model->imagesLinksData,
            'deleteUrl' => \yii\helpers\Url::toRoute(['/ajax/delete-history-image']),
            'showRemove' => false,
            'initialPreviewAsData' => true,
            'showUpload' => false,
            'overwriteInitial' => false,
            'allowedFileExtensions' => ['jpg', 'png', 'jpeg'],
            'maxFileSize' => 2800
        ],
        'options' => ['accept' => 'image/*'],
    ]); ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'custom',
        'clientOptions' => [
            'toolbar' => false
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
