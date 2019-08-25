<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bet}}`.
 */
class m190816_170021_create_bet_table extends Migration
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
            'outcome' => $this->string()->notNull(),
            'coef' => $this->float()->notNull(),
            'status' => $this->string()->notNull(),
        ]);

        $this->addForeignKey(
             'fk-bet-match_id',
             'bet',
             'match_id',
             'matches',
             'id',
             'CASCADE'
         );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropForeignKey(
             'fk-bet-match_id',
             'bet'
         );
        $this->dropTable('{{%bet}}');
    }
}
