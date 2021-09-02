<?php

use yii\db\Migration;

/**
 * Class m210902_113015_vacancies_fk_keys_specialization
 */
class m210902_113015_vacancies_fk_keys_specialization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_specializations_vacancies_id', 'vacancies', 'specialization', 'specializations', 'id');
    }


}
