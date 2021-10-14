<?php

use yii\db\Migration;

/**
 * Class m211013_201502_blog_legislation
 */
class m211013_201502_blog_legislation extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog_legislation}}', [
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'author_name' => $this->string(255)->notNull(),
            'page_name' => $this->string(255)->notNull(),
            'blog_category' => $this->string(255)->notNull(),
            'second_blog_category' => $this->string(255)->notNull(),
        ], $tableOptions);
    }
}
