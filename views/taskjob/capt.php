<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskJob */

$this->title = 'มอบหมายผู้ดำเนินการ';

$this->params['breadcrumbs'][] = ['label' => 'Task Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-job-capt">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?= $this->render('_capt', [
        'model' => $model,
        'data_task' => $data_task,
        'data_user' => $data_user
    ]) ?>

</div>
