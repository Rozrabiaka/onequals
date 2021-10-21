<?php

namespace backend\models;

use yii\data\ActiveDataProvider;

class UserFilter extends User
{
	public $email;

	public function rules()
	{
		return [
			['email', 'safe']
		];
	}

	public function search($params)
	{
		$query = User::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 10
			],
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere(['like', 'email', $params['UserFilter']['email']]);

		return $dataProvider;
	}
}