<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%phones}}`.
 */
class m190702_084312_create_phones_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%phones}}', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(10)->notNull(),
      			'operator' => $this->string(1)->notNull(),
      			'balance' => $this->integer()->notNull(),
      			'status' => $this->tinyInteger()->notNull(),
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
