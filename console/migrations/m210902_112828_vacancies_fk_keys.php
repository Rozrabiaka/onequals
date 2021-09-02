<?php

use yii\db\Migration;

/**
 * Class m210902_112828_vacancies_fk_keys
 */
class m210902_112828_vacancies_fk_keys extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_user_id_vacancies_employer', 'vacancies', 'employer_id', 'employer_users', 'id');
    }
}
