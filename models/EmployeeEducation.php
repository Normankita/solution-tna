<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "employee_education".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $level_id
 * @property int $year_completed
 *
 * @property Employee $employee
 * @property EducationLevel $level
 */
class EmployeeEducation extends ActiveRecord
{
    public static function tableName()
    {
        return 'employee_education';
    }

    public function rules()
    {
        return [
            [['employee_id', 'level_id', 'year_completed'], 'required'],
            [['employee_id', 'level_id', 'year_completed'], 'integer'],
        ];
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }

    public function getLevel()
    {
        return $this->hasOne(EducationLevel::class, ['id' => 'level_id']);
    }
}
