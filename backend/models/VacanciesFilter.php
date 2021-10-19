<?php

namespace backend\models;

use common\models\Vacancies;
use yii\data\ActiveDataProvider;

class VacanciesFilter extends Vacancies
{
    public $employer_id;

    public function rules()
    {
        return [
            ['employer_id', 'safe']
        ];
    }

    public function search($params)
    {

        $query = Vacancies::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->joinWith('employer')->where(['like', 'employer_users.company_name', $params['VacanciesFilter']['employer_id']]);

        return $dataProvider;
    }
}