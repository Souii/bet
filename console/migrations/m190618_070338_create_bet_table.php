<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bet}}`.
 */
class m190618_070338_create_bet_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bet}}', [
            'id' => $this->primaryKey(),
            'match_id' => $this->integer()->notNull(),
            'phone_number' => $this->string()->notNull(),
            'amount' => $this->integer()->notNull(),
            'outcome' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bet}}');
    }
}
