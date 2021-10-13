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

        if (!empty($params['price'])) {
            $priceList = $params['price'];
            $price = explode(',', $priceList);
            if (count($price) == 2) {
                $from = (int)$price[0];
                $to = (int)$price[1];
                if (($from >= 0 and $from < 1000000 and $from < $to) and ($to > 0 and $to < 1000000 and $to > $from)) {
                    $query->andWhere([
                        'and',
                        ['>', $tableName . '.wage', $from],
                        ['<', $tableName . '.wage', $to]
                    ]);
                }
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 10),
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_ASC
                ]
            ],
        ]);

        $dataProvider->setSort(['attributes' => ['date', 'wage']]);

        return $dataProvider;

    }

    public function getMaxPrice()
    {
        $maxPrice = 0;
        if (!empty(Yii::$app->user->identity->which_user) and Yii::$app->user->identity->which_user == EmployerUsers::EMPLOYER_WHICH_USER) {
            $maxPrice = Summary::find()->max('wage');
        } else {
            $maxPrice = Vacancies::find()->max('wage');
        }

        return $maxPrice;
    }
}