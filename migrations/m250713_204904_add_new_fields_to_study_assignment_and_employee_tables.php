<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%study_assignment}}`.
 */
class m250713_204904_add_new_fields_to_study_assignment_and_employee_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%study_assignment}}', 'competence', $this->string());
        $this->addColumn('{{%study_assignment}}', 'gap', $this->string());
        $this->addColumn('{{%study_assignment}}', 'additional_details', $this->text());
        $this->addColumn('{{%employee}}', 'skills', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%study_assignment}}', 'competence');
        $this->dropColumn('{{%study_assignment}}', 'gap');
        $this->dropColumn('{{%study_assignment}}', 'additional_details');
        $this->dropColumn('{{%employee}}', 'skills');
    }
}
