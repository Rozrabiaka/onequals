<?php

namespace frontend\models;

use common\models\Vacancies;
use common\models\EmployerUsers;
use common\models\Summary;
use Yii;
use yii\data\ActiveDataProvider;

class SearchForm extends \yii\base\Model
{
    public $search;
    public $specialization;
    public $city;
    public $hiddenCountry;
    public $price;

    public function rules()
    {
        return [
            // email has to be a valid email address
            ['search', 'string'],
        ];
    }

    public function search($params)
    {
        if (!empty($params)) $searchParams = $params['SearchForm'];

        if (!empty(Yii::$app->user->identity->which_user) and Yii::$app->user->identity->which_user == EmployerUsers::EMPLOYER_WHICH_USER) {
            $tableName = Summary::getTableSchema()->fullName;
            $query = Summary::find()
                ->joinWith('specializations')
                ->joinWith('employerType')
                ->joinWith('country')
                ->joinWith('worker')
                ->joinWith('user');
        } else {
            $tableName = Vacancies::getTableSchema()->fullName;
            $query = Vacancies::find()
                ->joinWith('specializations')
                ->joinWith('employerType')
                ->joinWith('country')
                ->joinWith('employer')
                ->joinWith('user');
        }

        if (!empty($searchParams['specialization'])) $query->andWhere([$tableName . '.specialization' => (int)$searchParams['specialization']]);
        if (!empty($searchParams['hiddenCountry'])) $query->andWhere([$tableName . '.country' => $searchParams['hiddenCountry']]);

        if (!empty($params['cartlist'])) {
            $cartList = $params['cartlist'];
            $list = explode(',', $cartList);
            foreach ($list as $value) {
                $query->orWhere([$tableName . '.specialization' => (int)$value]);
            }
        }

        if (!empty($params['typelist'])) {
            $typeList = $params['typelist'];
            $list = explode(',', $typeList);
            foreach ($list as $value) {
                $query->orWhere([$tableName . '.employer_type' => (int)$value]);
            }
        }

//        $query->filterWhere([
//            'and',
//            ['>', 'somePriceAttr', $this->price[0]],
//            ['<', 'somePriceAttr', $this->price[1]]
//        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 1),
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_ASC
                ]
            ],
        ]);

        return $dataProvider;
    }
}