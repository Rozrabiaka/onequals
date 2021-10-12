<?php

use yii\db\Migration;

/**
 * Class m211007_150513_summary_fk_worker
 */
class m211007_150513_summary_fk_worker extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_worker_summary_worker_id', 'summary', 'worker_id', 'search_work_user', 'id');
    }
}
