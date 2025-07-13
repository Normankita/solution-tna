<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $name
 * @property int $staff_id
 *
 * @property Staff $staff
 * @property EmployeeEducation[] $educationRecords
 * @property EmployeeEducation|null $latestEducation
 * @property StudyAssignment[] $studyAssignments
 */
class Employee extends ActiveRecord
{
    public $skills;
    public static function tableName()
    {
        return 'employee';
    }

    public function rules()
    {
        return [
            [['name', 'staff_id'], 'required'],
            [['staff_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function getStaff()
    {
        return $this->hasOne(Staff::class, ['id' => 'staff_id']);
    }

    public function getEducationRecords()
    {
        return $this->hasMany(EmployeeEducation::class, ['employee_id' => 'id']);
    }

    public function getEducationLevel()
    {
        return $this->hasOne(EducationLevel::class, ['id' => 'level_id'])
            ->via('latestEducation');
    }

    public function getEducationHistory()
    {
        return $this->hasMany(EmployeeEducation::class, ['employee_id' => 'id']);
    }

    public function getSkillsAsString()
    {
        return implode(', ', array_column($this->skills, 'name')); // if relation
    }



    public function getLatestEducation()
    {
        return $this->hasOne(EmployeeEducation::class, ['employee_id' => 'id'])
            ->orderBy(['year_completed' => SORT_DESC])
            ->with('level');
    }

    public function getStudyAssignments()
    {
        return $this->hasMany(StudyAssignment::class, ['employee_id' => 'id']);
    }
}