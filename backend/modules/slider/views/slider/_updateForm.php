<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image[]')->widget(FileInput::classname(), [
        'pluginOptions' => [
            'initialPreview' => $model->imagesLinks,
            'initialPreviewConfig' => $model->imagesLinksData,
            'deleteUrl' => Url::toRoute(['/ajax/delete-product-image']),
            'showRemove' => false,
            'initialPreviewAsData' => true,
            'showUpload' => false,
            'overwriteInitial' => false,
            'allowedFileExtensions' => ['jpg', 'png', 'jpeg'],
            'maxFileSize' => 2800
        ],
        'options' => ['accept' => 'image/*'],
    ]); ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
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
