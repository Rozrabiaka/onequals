<?php

use yii\db\Migration;

/**
 * Class m211010_131319_like_vacanies
 */
class m211010_131319_like_vacanies extends Migration
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

        $this->createTable('{{%like_vacancies}}', [
            'id' => $this->primaryKey(),
            'vacancies_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_like_vacancies_id', 'like_vacancies', 'vacancies_id', 'vacancies', 'id');
    }
}
