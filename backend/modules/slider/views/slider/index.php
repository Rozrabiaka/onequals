<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sliders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Slider', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'img_path',
                'label' => 'Картинка',
                'value' => function($model){
                    if(!empty($model->img_path)) return $model->img_path;
                    else return '';
                },
                'format' => ['image', ['width' => '230', 'height' => '200']],
            ],
            'text:html',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
