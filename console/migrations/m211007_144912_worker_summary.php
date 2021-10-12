<?php

use yii\db\Migration;

/**
 * Class m211007_144912_worker_summary
 */
class m211007_144912_worker_summary extends Migration
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

        $this->createTable('{{%summary}}', [
            'id' => $this->primaryKey(),
            'worker_id' => $this->integer()->notNull(),
            'company_name' => $this->string(255)->notNull(),
            'specialization' => $this->integer()->notNull(), //FK specializations
            'country' => $this->integer()->notNull(), // FK COUNTRY locality
            'wage' => $this->string(255)->notNull(), // ЗП
            'description' => $this->text()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk_worker_summary_id', 'summary', 'specialization', 'specializations', 'id');
        $this->addForeignKey('fk_worker_summary_employment_type_fk', 'summary', 'employer_type', 'employment_type', 'id');
    }

}
