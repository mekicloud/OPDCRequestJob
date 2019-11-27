<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskAssign */

$this->title = 'Update Task Assign: ' . $model->task_id;
$this->params['breadcrumbs'][] = ['label' => 'Task Assigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->task_id, 'url' => ['view', 'task_id' => $model->task_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-assign-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
