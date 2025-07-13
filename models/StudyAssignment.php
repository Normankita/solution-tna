<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "study_assignment".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $level_id
 * @property int $staff_id
 * @property string|null $file_path
 * @property string $status
 * @property int|null $approved_by
 * @property string $date_assigned
 *
 * @property Employee $employee
 * @property Staff $staff
 * @property Staff|null $approver
 * @property EducationLevel $educationLevel
 */
class StudyAssignment extends ActiveRecord
{
    /** @var UploadedFile */
    public $file;

    public static function tableName()
    {
        return 'study_assignment';
    }

    public function rules()
    {
        return [
            [['employee_id', 'level_id', 'staff_id', 'competence', 'gap'], 'required'],
            [['employee_id', 'level_id', 'staff_id', 'approved_by'], 'integer'],
            [['date_assigned'], 'safe'],
            [['status'], 'string', 'max' => 20],
            [['competence', 'gap'], 'string', 'max' => 255],
            [['additional_details'], 'string'],
            [['file_path'], 'string', 'max' => 255],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,doc,docx'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'employee_id' => 'Employee',
            'level_id' => 'Next Education Level',
            'staff_id' => 'Assigned By',
            'file_path' => 'Study Plan File',
            'status' => 'Status',
            'approved_by' => 'Approved By',
            'date_assigned' => 'Date Assigned',
        ];
    }

    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['id' => 'employee_id']);
    }

    public function getEducationLevel()
    {
        return $this->hasOne(EducationLevel::class, ['id' => 'level_id']);
    }

    public function getStaff()
    {
        return $this->hasOne(Staff::class, ['id' => 'staff_id']);
    }

    public function getApprover()
    {
        return $this->hasOne(Staff::class, ['id' => 'approved_by']);
    }
}
