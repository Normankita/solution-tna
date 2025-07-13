<?php

namespace app\commands;

use yii\console\Controller;
use app\models\Staff;
use app\models\Employee;
use app\models\EducationLevel;
use Yii;

class SeedController extends Controller
{
    public function actionIndex()
    {
        echo "Seeding data...\n";

        // Create staff
        $staff = new Staff();
        $staff->name = 'John Supervisor';
        $staff->save();

        // Create employees
        for ($i = 1; $i <= 5; $i++) {
            $employee = new Employee();
            $employee->name = "Employee $i";
            $employee->staff_id = $staff->id;
            $employee->save();
        }

        // Create education levels
        $levels = ['Certificate', 'Diploma', 'Degree', 'Masters'];
        foreach ($levels as $level) {
            $edu = new EducationLevel();
            $edu->name = $level;
            $edu->save();
        }

        echo "Seeding complete!\n";
    }
}
