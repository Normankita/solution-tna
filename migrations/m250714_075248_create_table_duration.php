<?php

use yii\db\Migration;

class m250714_075248_create_table_duration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('course_period', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250714_075248_create_table_duration cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250714_075248_create_table_duration cannot be reverted.\n";

        return false;
    }
    */
}
