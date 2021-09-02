<?php

use yii\db\Migration;

/**
 * Class m210902_113901_fk_vacancies_column_fk
 */
class m210902_113901_fk_vacancies_column_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('vacancies', 'employer_type', $this->smallInteger()->defaultValue(0));
    }
}
