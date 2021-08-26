<?php

use yii\db\Migration;

/**
 * Class m210826_164227_age_company
 */
class m210826_164227_age_company extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%age_company}}', [
            'id' => $this->primaryKey(),
            'age_name' => $this->string(255)->notNull(),
        ], $tableOptions);
    }
}

