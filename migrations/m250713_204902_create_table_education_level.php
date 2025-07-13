<?php

use yii\db\Migration;

class m250713_204902_create_table_education_level extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('education_level', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250713_204902_create_table_education_level cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250713_204902_create_table_education_level cannot be reverted.\n";

        return false;
    }
    */
}
