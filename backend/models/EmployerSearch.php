<?php

namespace backend\models;

use yii\data\ActiveDataProvider;

class EmployerSearch extends \common\models\EmployerUsers
{

    public $search_company_name;

    public function rules()
    {
        return [
            ['search_company_name', 'safe']
        ];
    }

    public function search($params)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'company_name', $params['EmployerSearch']['search_company_name']]);

        return $dataProvider;
    }
}