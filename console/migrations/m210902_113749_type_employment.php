<?php

use yii\db\Migration;

/**
 * Class m210902_113749_type_employment
 */
class m210902_113749_type_employment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%employment_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(), // ЗП
        ], $tableOptions);
    }
}
