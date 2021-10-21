<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
		<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Delete', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		]) ?>
    </p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'username',
			'auth_key',
			'password_hash',
			'password_reset_token',
			'email:email',
			[
				'attribute' => 'status',
				'value' => function ($model) {
					return $model->getStatusActiveUserByStatusId($model->status);
				},
			],
			'created_at',
			'updated_at',
			'verification_token',
			[
                'attribute' => 'admin',
                'value' => function($model){
	                if($model->admin == 1) return 'Дозволено вхід в адмін систему';
	                return 'Заборонений вхід в адмін систему';
                }
			],
			[
				'attribute' => 'user_role',
				'value' => function ($model) {
					return $model->getUserAdminStatus($model->id);
				},
			],
		],
	]) ?>

</div>
