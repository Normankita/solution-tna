<?php

use yii\db\Migration;

class m250713_204903_create_table_study_assignment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('study_assignment', [
            'id' => $this->primaryKey(),
            'employee_id' => $this->integer()->notNull(),
            'level_id' => $this->integer()->notNull(),
            'staff_id' => $this->integer()->notNull(),
            'file_path' => $this->string()->null(),
            'status' => $this->string()->defaultValue('pending'),
            'approved_by' => $this->integer()->null(),
            'required_competence' => $this->string(),
            'recommended_course' => $this->string(),
            'additional_info' => $this->text()->null(),
            'date_assigned' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey('fk_assignment_employee', 'study_assignment', 'employee_id', 'employee', 'id', 'CASCADE');
        $this->addForeignKey('fk_assignment_staff', 'study_assignment', 'staff_id', 'staff', 'id', 'CASCADE');
        $this->addForeignKey('fk_assignment_level', 'study_assignment', 'level_id', 'education_level', 'id', 'CASCADE');
        $this->addForeignKey('fk_assignment_approver', 'study_assignment', 'approved_by', 'staff', 'id', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250713_204903_create_table_study_assignment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250713_204903_create_table_study_assignment cannot be reverted.\n";

        return false;
    }
    */
}
