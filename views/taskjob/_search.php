<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskJobSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-job-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'task_id') ?>

    <?= $form->field($model, 'task_detail') ?>

    <?= $form->field($model, 'typej_id') ?>

    <?= $form->field($model, 'task_date_start') ?>

    <?= $form->field($model, 'task_time_start') ?>

    <?php // echo $form->field($model, 'task_date_end') ?>

    <?php // echo $form->field($model, 'task_time_end') ?>

    <?php // echo $form->field($model, 'task_owner') ?>

    <?php // echo $form->field($model, 'task_order_date') ?>

    <?php // echo $form->field($model, 'task_order_time') ?>

    <?php // echo $form->field($model, 'task_location') ?>

    <?php // echo $form->field($model, 'task_personal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
