<?php

use yii\db\Migration;

/**
 * Class m210826_173336_emplyer_add_fk_user_id
 */
class m210826_173336_emplyer_add_fk_user_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_user_id', 'employer_users', 'user_id', 'user', 'id');
    }
}
