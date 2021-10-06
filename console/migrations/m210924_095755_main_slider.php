<?php

use yii\db\Migration;

/**
 * Class m210924_095755_main_slider
 */
class m210924_095755_main_slider extends Migration
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

        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),
            'img_path' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
        ], $tableOptions);
    }
}
