<?php

use yii\db\Migration;

/**
 * Class m210826_124726_employer_table
 */
class m210826_124726_employer_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%employer_users}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'company_name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'specialization' => $this->integer()->notNull(), //FK specializations
            'country' => $this->integer()->notNull(), // FK COUNTRY locality
            'webpage' => $this->string(255)->notNull(),
            'facebook' => $this->string(255)->notNull(),
            'instagram' => $this->string(255)->notNull(),
            'twitter' => $this->string(255)->notNull(),
            'LinkedIn' => $this->string(255)->notNull(),
            'age_company' => $this->integer()->notNull(), // FK table age_company
            'count_company_workers' => $this->integer()->notNull(), //FK TABLE count_company_workers
            'company_popularity' =>  $this->integer()->notNull(), // FK TABLE company_popularity
            'company_description' => $this->text()->notNull(),
        ], $tableOptions);
    }
}
