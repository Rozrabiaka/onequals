<?php

use yii\db\Migration;

/**
 * Class m211013_201444_blog_summary
 */
class m211013_201444_blog_summary extends Migration
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

        $this->createTable('{{%blog_summary}}', [
            'id' => $this->primaryKey(),
            'description' => $this->text()->notNull(),
            'author_name' => $this->string(255)->notNull(),
            'page_name' => $this->string(255)->notNull(),
            'blog_category' => $this->string(255)->notNull(),
            'second_blog_category' => $this->string(255)->notNull(),
        ], $tableOptions);
    }

}
