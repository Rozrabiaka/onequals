<?php

use yii\db\Migration;

/**
 * Class m210825_133250_add_columns_to_user
 */
class m210825_133250_add_columns_to_user extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'user_role', $this->smallInteger()->defaultValue(0));
    }
}
