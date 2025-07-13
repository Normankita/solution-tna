<?php

use yii\db\Migration;

class m250713_204902_create_table_employee_education extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('employee_education', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer()->notNull(),
            'level_id' => $this->integer()->notNull(),
            'year_completed' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_edu_employee', 'employee_education', 'employee_id', 'employee', 'id', 'CASCADE');
        $this->addForeignKey('fk_edu_level', 'employee_education', 'level_id', 'education_level', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250713_204902_create_table_employee_education cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250713_204902_create_table_employee_education cannot be reverted.\n";

        return false;
    }
    */
}
