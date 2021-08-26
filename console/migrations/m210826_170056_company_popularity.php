<?php

use yii\db\Migration;

/**
 * Class m210826_170056_company_popularity
 */
class m210826_170056_company_popularity extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%company_popularity}}', [
            'id' => $this->primaryKey(),
            'company_popularity' => $this->string(255)->notNull(),
        ], $tableOptions);
    }
}
