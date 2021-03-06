<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskAdmin */

$this->title = 'Update Task Admin: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Task Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-admin-update">

    <div class="panel panel-info">
        <div class="panel-heading">
            <?= Html::a('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> ย้อนกลับ', ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        </div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>

    </div>