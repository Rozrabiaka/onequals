<?php

use yii\db\Migration;

/**
 * Class m210826_174901_seach_user_add_specialization_fk
 */
class m210826_174901_seach_user_add_specialization_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_specialization_id_search', 'search_work_user', 'specialization', 'specializations', 'id');
    }
}
