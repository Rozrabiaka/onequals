<?php

use yii\db\Migration;

/**
 * Class m210826_171919_employer_table_fk
 */
class m210826_171919_employer_table_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_specialization_id', 'employer_users', 'specialization', 'specializations', 'id');
        $this->addForeignKey('fk_age_company_id', 'employer_users', 'age_company', 'age_company', 'id');
        $this->addForeignKey('fk_count_company_workers_id', 'employer_users', 'count_company_workers', 'count_company_workers', 'id');
        $this->addForeignKey('fk_company_popularity_id', 'employer_users', 'company_popularity', 'company_popularity', 'id');
    }

}
