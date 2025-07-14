<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use app\models\Employee;
use app\models\EducationLevel;
use app\models\StudyAssignment;
use yii\web\UploadedFile;



class StudyAssignmentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only' => ['assign', 'review'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // <-- only authenticated users
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new \app\models\StudyAssignment(); // Make sure the model is properly imported

        $staffId = Yii::$app->user->id;

        $employees = \app\models\Employee::find()
            ->where(['staff_id' => 1])
            ->all();

        $educationLevels = \app\models\EducationLevel::find()->all();

        return $this->render('index', [
            'model' => $model, // ✅ This is the missing variable
            'employees' => $employees,
            'educationLevels' => $educationLevels,
        ]);
    }


    public function actionEmployeeDetails($id)
{
    Yii::$app->response->format = Response::FORMAT_JSON;
    $employee = Employee::findOne($id);

    if (!$employee) {
        return ['error' => 'Employee not found'];
    }

    $latestEducation = $employee->getLatestEducation()->one(); // relation should exist
    return [
        'name' => $employee->name,
        'current_education' => isset($latestEducation) && isset($latestEducation->level) ? $latestEducation->level->name : 'N/A',
        'skills' => $employee->skills ?? 'None',
        'next_recommendation' => 'Masters in Data Science',
    ];
}



    public function actionHistory($employee_id)
    {
        $employee = Employee::findOne($employee_id);

        if (!$employee) {
            throw new \yii\web\NotFoundHttpException("Employee not found.");
        }

        $assignments = StudyAssignment::find()
            ->where(['employee_id' => $employee_id])
            ->orderBy(['date_assigned' => SORT_DESC])
            ->with(['educationLevel', 'staff', 'approver'])
            ->all();

        return $this->render('history', [
            'employee' => $employee,
            'assignments' => $assignments,
        ]);
    }

    public function actionAssign()
    {
        // dd(Yii::$app->request->post());
        $model = new StudyAssignment();
        $model->load(Yii::$app->request->post());
        $model->file = UploadedFile::getInstance($model, 'file');
        // $model->staff_id = Yii::$app->user->id;
        $model->staff_id = 1;

        $model->status = 'pending';

        if ($model->file) {
            $filename = 'uploads/' . uniqid() . '.' . $model->file->extension;
            $model->file->saveAs($filename);
            $model->file_path = $filename;
        }

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Skill assigned.');
        }
        if (!$model->save()) {
            Yii::$app->session->setFlash('error', json_encode($model->errors));
        }

        return $this->redirect(['index']);


    }


    public function actionReview()
    {
        $assignments = StudyAssignment::find()->where(['status' => 'pending'])->all();
        return $this->render('review', compact('assignments'));
    }

    public function actionApprove($id)
    {
        $model = StudyAssignment::findOne($id);
        $model->status = 'approved';
        $model->approved_by = Yii::$app->user->id;
        $model->save();
        return $this->redirect(['review']);
    }

}
