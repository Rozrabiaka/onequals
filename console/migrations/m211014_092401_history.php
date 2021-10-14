<?php

use yii\db\Migration;

/**
 * Class m211014_092401_history
 */
class m211014_092401_history extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),
            'img' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
        ], $tableOptions);
    }

}
