<?php

namespace backend\models;

use common\models\SearchWorkUser;
use yii\data\ActiveDataProvider;

class SearchWorkUserFilter extends SearchWorkUser
{
	public $user_id;

	public function rules()
	{
		return [
			['user_id', 'safe']
		];
	}

	public function search($params)
	{
		$query = SearchWorkUser::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 10
			],
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->joinWith('user')->where(['like', 'user.email', $params['SearchWorkUserFilter']['user_id']]);

		return $dataProvider;
	}
}