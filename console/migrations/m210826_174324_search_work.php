<?php

use yii\db\Migration;

/**
 * Class m210826_174324_search_work
 */
class m210826_174324_search_work extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%search_work_user}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(255)->notNull(),
            'lastname' => $this->string(255)->notNull(),
            'patronymic' => $this->string(255)->notNull(),
            'specialization' => $this->integer()->notNull(), //FK specializations
            'facebook' => $this->string(255)->notNull(),
            'instagram' => $this->string(255)->notNull(),
            'twitter' => $this->string(255)->notNull(),
            'LinkedIn' => $this->string(255)->notNull(),
            'country' => $this->integer()->notNull(), // FK COUNTRY locality
            'description' => $this->text()->notNull(),
        ], $tableOptions);
    }
}
