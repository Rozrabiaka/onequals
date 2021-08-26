<?php

use yii\db\Migration;

/**
 * Class m210826_174619_work_user_add_fk_user_id_add_columns
 */
class m210826_174619_work_user_add_fk_user_id_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('search_work_user', 'user_id', $this->integer(11));

        $this->addForeignKey('fk_user_id_search_work_user', 'search_work_user', 'user_id', 'user', 'id');
    }
}
