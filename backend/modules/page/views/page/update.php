<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use dosamigos\ckeditor\CKEditor;

$this->title = 'OnEquals - Оновити сторінку';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="update-blog-page">
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <div class="row">
        <div class="col-xl-12">
            <?= $form->field($model, 'page_name')->textInput(['maxlength' => true, 'placeholder' => 'Конституція  Україні та навіщо вона потрібна']) ?>
        </div>
        <div class="col-xl-12">
            <p>Залиште поле пустим якщо не хочете відображати ім'я автора</p>
            <?= $form->field($model, 'author_name')->textInput(['maxlength' => true, 'placeholder' => 'Олег Глазков']) ?>
        </div>
        <div class="col-xl-12">
            <?= $form->field($model, 'blog_category')->dropDownList($createBlogModel->getBlogCategory()) ?>
        </div>
        <div class="col-xl-12">
            <?= $form->field($model, 'second_blog_category')->dropDownList($createBlogModel->getSecondBlogCategory()) ?>
        </div>
        <div class="col-xl-12">
            <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'custom',
                'clientOptions' => [
                    'toolbar' => false
                ]
            ]); ?>
        </div>
        <div class="col-xl-6">
            <div class="form-group">
                <?= Html::submitButton('Оновити', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
