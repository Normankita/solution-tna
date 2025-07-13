<?php

use yii\db\Migration;

class m250713_204852_create_table_employee extends Migration
{
    public function up()
    {
        $this->createTable('employee', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'staff_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-employee-staff_id',
            'employee',
            'staff_id',
            'staff',
            'id',
            'CASCADE'
        );
    }

}
