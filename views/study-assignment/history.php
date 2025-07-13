<?php
use yii\helpers\Html;

$this->title = "Study Assignment History for {$employee->name}";
?>

<h2><?= Html::encode($this->title) ?></h2>

<?php if (empty($assignments)): ?>
    <p>No assignments found.</p>
<?php else: ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Assigned On</th>
                <th>Assigned By</th>
                <th>Next Level</th>
                <th>Status</th>
                <th>Approved By</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignments as $assignment): ?>
                <tr>
                    <td><?= Yii::$app->formatter->asDatetime($assignment->date_assigned) ?></td>
                    <td><?= Html::encode($assignment->staff->name) ?></td>
                    <td><?= Html::encode($assignment->educationLevel->name) ?></td>
                    <td><?= Html::encode(ucfirst($assignment->status)) ?></td>
                    <td><?= Html::encode($assignment->approver->name ?? '-') ?></td>
                    <td>
                        <?php if ($assignment->file_path): ?>
                            <?= Html::a('Download', "@web/{$assignment->file_path}", ['target' => '_blank']) ?>
                        <?php else: ?>
                            No File
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
