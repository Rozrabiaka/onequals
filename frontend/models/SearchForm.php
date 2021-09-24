<?php

namespace frontend\models;

class SearchForm extends \yii\base\Model
{
    public $search;
    public $specialization;
    public $city;

    public function rules()
    {
        return [
            // email has to be a valid email address
            ['search', 'string'],
        ];
    }
}