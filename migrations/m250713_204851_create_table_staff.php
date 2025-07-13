<?php

use yii\db\Migration;

class m250713_204851_create_table_staff extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('staff', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250713_204858_create_table_staff cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250713_204858_create_table_staff cannot be reverted.\n";

        return false;
    }
    */
}
