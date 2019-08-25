<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phones}}`.
 */
class m190816_165932_create_phones_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%phones}}', [
            'id' => $this->primaryKey(),
            'phone_number' => $this->string(10)->notNull(),
      			'operator' => $this->string()->notNull(),
      			'balance' => $this->integer()->notNull(),
      			'status' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%phones}}');
    }
}
