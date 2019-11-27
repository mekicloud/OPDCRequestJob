<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskApprovedSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-approved-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'task_id') ?>

    <?= $form->field($model, 'approved1') ?>

    <?= $form->field($model, 'approved1_date') ?>

    <?= $form->field($model, 'approved1_time') ?>

    <?= $form->field($model, 'approved2') ?>

    <?php // echo $form->field($model, 'approved2_date') ?>

    <?php // echo $form->field($model, 'approved2_time') ?>

    <?php // echo $form->field($model, 'approved3') ?>

    <?php // echo $form->field($model, 'approved3_date') ?>

    <?php // echo $form->field($model, 'approved3_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
