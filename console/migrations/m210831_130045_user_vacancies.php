<?php

use yii\db\Migration;

/**
 * Class m210831_130045_user_vacancies
 */
class m210831_130045_user_vacancies extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%vacancies}}', [
            'id' => $this->primaryKey(),
            'employer_id' => $this->integer()->notNull(),
            'company_name' => $this->string(255)->notNull(),
            'specialization' => $this->integer()->notNull(), //FK specializations
            'country' => $this->integer()->notNull(), // FK COUNTRY locality
            'wage' => $this->string(255)->notNull(), // ЗП
            'description' => $this->text()->notNull(),
        ], $tableOptions);
    }
}
