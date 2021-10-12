<?php

use yii\db\Migration;

/**
 * Class m211010_132811_add_columns_and_fk_like
 */
class m211010_132811_add_columns_and_fk_like extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('like_summary', 'user_id', $this->integer(11));
        $this->addForeignKey('fk_user_id_like_summary_user', 'like_summary', 'user_id', 'user', 'id');

        $this->addColumn('like_vacancies', 'user_id', $this->integer(11));
        $this->addForeignKey('fk_user_id_like_vacancies_user', 'like_vacancies', 'user_id', 'user', 'id');
    }

}
