<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%matches}}`.
 */
class m190816_165050_create_matches_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%matches}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'match_details_id' => $this->integer()->notNull(),
            'first_team_coef' => $this->float()->notNull(),
            'second_team_coef' => $this->float()->notNull(),
            'draw_coef' => $this->float()->notNull(),
            'start_date' => $this->dateTime()->notNull(),
            'status' => $this->string()->notNull(),
            'is_live' => $this->boolean()->defaultValue(false)->notNull()
        ]);

        $this->addForeignKey(
             'fk-matches-category_id',
             'matches',
             'category_id',
             'category',
             'id',
             'CASCADE'
         );

        $this->addForeignKey(
             'fk-matches-match_details_id',
             'matches',
             'match_details_id',
             'match_details',
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
                 'fk-matches-category_id',
                 'matches'
             );
        $this->dropForeignKey(
               'fk-matches-match_details_id',
               'matches'
           );
        $this->dropTable('{{%matches}}');
    }
}
