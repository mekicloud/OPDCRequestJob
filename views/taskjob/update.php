<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskJob */

$this->title = 'Update Task Job: ' . $model->task_id;
$this->params['breadcrumbs'][] = ['label' => 'Task Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->task_id, 'url' => ['view', 'id' => $model->task_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-job-update">

    <div class="row">
        <div>
            <?php // Html::a('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> ย้อนกลับ', ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        </div>
        <div >
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>

    </div>
</div>