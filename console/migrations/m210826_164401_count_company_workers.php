<?php

use yii\db\Migration;

/**
 * Class m210826_164401_count_company_workers
 */
class m210826_164401_count_company_workers extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%count_company_workers}}', [
            'id' => $this->primaryKey(),
            'count_company_workers' => $this->string(255)->notNull(),
        ], $tableOptions);
    }
}
