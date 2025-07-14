<?php

use yii\db\Migration;

class m250714_075840_add_duration_financial_year_to_study_assignment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('study_assignment', 'duration', $this->string());
        $this->addColumn('study_assignment', 'financial_year', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250714_075840_add_duration_financial_year_to_study_assignment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250714_075840_add_duration_financial_year_to_study_assignment cannot be reverted.\n";

        return false;
    }
    */
}
