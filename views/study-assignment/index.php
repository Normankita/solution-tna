<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Assign Employee to Study';

\yii\web\JqueryAsset::register($this);
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

<?php $form = ActiveForm::begin([
    'action' => ['study-assignment/assign'],
    'method' => 'post',
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<?= $form->field($model, 'employee_id')->dropDownList(
    ArrayHelper::map($employees, 'id', 'name'),
    ['prompt' => 'Select Employee', 'id' => 'employee-dropdown']
) ?>

<div id="employee-details" style="margin-top: 20px;"></div>

<?= $form->field($model, 'level_id')->dropDownList(
    ArrayHelper::map($educationLevels, 'id', 'name'),
    ['prompt' => 'Select Next Education Level']
) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<br>
<?= Html::submitButton('Assign to Study', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>

<script>
$('#employee-dropdown').on('change', function() {

            console.log("I am the executed man ");

    const empId = $(this).val();
    if (!empId) return;

    $.ajax({
        url: '<?= Url::to(['study-assignment/employee-details']) ?>',
        data: { id: empId },
        success: function(data) {
            if (data.error) {
                $('#employee-details').html('<div class="alert alert-danger">' + data.error + '</div>');
                return;
            }

            $('#employee-details').html(`
                <div class="card mt-3">
                    <div class="card-body">
                        <h4>Employee Details</h4>
                        <p><strong>Name:</strong> ${data.name}</p>
                        <p><strong>Current Education:</strong> ${data.current_education}</p>
                        <p><strong>Skills:</strong> ${data.skills}</p>
                        <p><strong>Recommended Next Study:</strong> ${data.next_recommendation}</p>
                    </div>
                </div>
            `);
        },
        error: function() {
            $('#employee-details').html('<div class="alert alert-danger">Could not load employee details.</div>');
        }
    });
});
</script>
