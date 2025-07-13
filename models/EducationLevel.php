<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "education_level".
 *
 * @property int $id
 * @property string $name
 *
 * @property EmployeeEducation[] $employeeEducations
 * @property StudyAssignment[] $studyAssignments
 */
class EducationLevel extends ActiveRecord
{
    public static function tableName()
    {
        return 'education_level';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function getEmployeeEducations()
    {
        return $this->hasMany(EmployeeEducation::class, ['level_id' => 'id']);
    }

    public function getStudyAssignments()
    {
        return $this->hasMany(StudyAssignment::class, ['level_id' => 'id']);
    }
}
