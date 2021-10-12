<?php

use yii\db\Migration;

/**
 * Class m211007_145409_summary_fk
 */
class m211007_145409_summary_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_worker_summary_employment_type_fk', 'summary', 'employer_type', 'employment_type', 'id');
    }

}
