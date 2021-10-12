<?php

use yii\db\Migration;

/**
 * Class m211010_131313_like_summary
 */
class m211010_131313_like_summary extends Migration
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

        $this->createTable('{{%like_summary}}', [
            'id' => $this->primaryKey(),
            'summary_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_like_summary_id', 'like_summary', 'summary_id', 'summary', 'id');
    }

}
