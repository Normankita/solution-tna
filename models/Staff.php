<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string $name
 *
 * @property Employee[] $employees
 * @property StudyAssignment[] $assignmentsCreated
 * @property StudyAssignment[] $assignmentsApproved
 */
class Staff extends ActiveRecord
{
    public static function tableName()
    {
        return 'staff';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function getEmployees()
    {
        return $this->hasMany(Employee::class, ['staff_id' => 'id']);
    }

    public function getAssignmentsCreated()
    {
        return $this->hasMany(StudyAssignment::class, ['staff_id' => 'id']);
    }

    public function getAssignmentsApproved()
    {
        return $this->hasMany(StudyAssignment::class, ['approved_by' => 'id']);
    }
}
