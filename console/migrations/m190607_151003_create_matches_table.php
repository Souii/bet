<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%matches}}`.
 */
class m190607_151003_create_matches_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%matches}}', [
            'id' => $this->primaryKey(),
            'discipline' => $this->integer()->notNull(),
            'team_1' => $this->string()->notNull(),
            'team_2' => $this->string()->notNull(),
            'start_date' => $this->dateTime()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%matches}}');
    }
}
