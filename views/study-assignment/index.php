<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Skills Matrix Builder';
\yii\web\JqueryAsset::register($this);
?>

<h2><?= Html::encode($this->title) ?></h2>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div>
<?php elseif (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger"><?= Yii::$app->session->getFlash('error') ?></div>
<?php endif; ?>

<div class=" mt-4">
    <div class="">
        <?php $form = ActiveForm::begin([
            'action' => ['study-assignment/assign'],
            'method' => 'post',
            'options' => ['enctype' => 'multipart/form-data', 'id' => 'study-form']
        ]); ?>

        <div class="row">
            <ul class="mx-5">
                <li>Fill in the form below to add a new skill entry for your sub-ordinate</li>
            </ul>
            <!-- Left Column -->
            <div class="col-md-6 p-5 card mx-4 shadow">
                <?= $form->field($model, 'employee_id')->dropDownList(
                    ArrayHelper::map($employees, 'id', 'name'),
                    [
                        'prompt' => 'Select Employee',
                        'id' => 'employee-dropdown',
                        'data-url' => Url::to(['study-assignment/employee-details']),
                        'class' => 'form-select'
                    ]
                ) ?>

                <?= $form->field($model, 'competence')->textarea([
                    'rows' => 2,
                    'class' => 'form-control py-2',
                ]) ?>

                <?= $form->field($model, 'gap')->textarea([
                    'rows' => 2,
                    'class' => 'form-control',
                ]) ?>

                <?= $form->field($model, 'file')->fileInput(['class' => 'form-control']) ?>

                <?= $form->field($model, 'level_id')->dropDownList(
                    ArrayHelper::map($educationLevels, 'id', 'name'),
                    ['prompt' => 'Select Next Education Level', 'class' => 'form-select']
                ) ?>

                <?= $form->field($model, 'additional_details')->textarea([
                    'rows' => 2,
                    'class' => 'form-control'
                ]) ?>

                <?= $form->field($model, 'duration')->textInput(['class' => 'form-control']) ?>

                <?= $form->field($model, 'financial_year')->dropDownList([
                    '2023/2024' => '2023/2024',
                    '2024/2025' => '2024/2025',
                    '2025/2026' => '2025/2026',
                ], ['prompt' => 'Select Financial Year', 'class' => 'form-select']) ?>

                <div class="mt-3">
                    <?= Html::submitButton('Assign to Study', [
                        'class' => 'btn btn-teal text-white',
                        'style' => 'background-color: #1abc9c;'
                    ]) ?>
                </div>
            </div>

            <!-- Right Column begins here  -->
            <div class="col-md-5 ">
                <div id="employee-details" class="shadow my-10" style="display: none; margin-top: 20px;"></div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$this->registerJsFile(
    '@web/js/study-assignment.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>