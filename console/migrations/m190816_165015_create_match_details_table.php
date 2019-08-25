<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%match_details}}`.
 */
class m190816_165015_create_match_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%match_details}}', [
            'id' => $this->primaryKey(),
            'first_team' => $this->string()->notNull(),
            'first_team_score' => $this->integer()->defaultValue(0),
            'second_team' => $this->string()->notNull(),
            'second_team_score' => $this->integer()->defaultValue(0),
            'outcome' => $this->string()
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%match_details}}');
    }
}
