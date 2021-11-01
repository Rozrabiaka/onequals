<?php

use yii\db\Migration;

/**
 * Class m211101_105320_google_auth
 */
class m211101_105320_google_auth extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable('auth', [
			'id' => $this->primaryKey(),
			'user_id' => $this->integer()->notNull(),
			'source' => $this->string()->notNull(),
			'source_id' => $this->string()->notNull(),
		]);

		$this->addForeignKey('fk-auth-user_id-user-id', 'auth', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }
}
