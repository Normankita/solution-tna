<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

\yii\web\JqueryAsset::register($this);
$this->title = 'Assign Employee to Study';
?>

<h2><?= Html::encode($this->title) ?></h2>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php elseif (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'action' => ['study-assignment/assign'],
            'method' => 'post',
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>

        <?= $form->field($model, 'employee_id')->dropDownList(
            ArrayHelper::map($employees, 'id', 'name'),
            ['prompt' => 'Select Employee', 'id' => 'employee-dropdown']
        ) ?>

        <div id="employee-details" style="margin-top: 20px; padding: 20px; border: 1px solid #ddd; border-radius: 5px; display: none;"></div>


        <?= $form->field($model, 'level_id')->dropDownList(
            ArrayHelper::map($educationLevels, 'id', 'name'),
            ['prompt' => 'Select Next Education Level']
        ) ?>

        <?= $form->field($model, 'competence')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'gap')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'additional_details')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'file')->fileInput() ?>

        <br>
        <?= Html::submitButton('Assign to Study', ['class' => 'btn btn-primary']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$this->registerJs(
    "var yii = yii || {}; yii.urls = { employeeDetails: '" . Url::to(['study-assignment/employee-details']) . "' };",
    \yii\web\View::POS_HEAD
);
$this->registerJsFile('@web/js/study-assignment.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
