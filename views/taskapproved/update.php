<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskApproved */

$this->title = 'Update Task Approved: ' . $model->task_id;
$this->params['breadcrumbs'][] = ['label' => 'Task Approveds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->task_id, 'url' => ['view', 'id' => $model->task_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-approved-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
