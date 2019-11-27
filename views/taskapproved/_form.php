<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskApproved */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-approved-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'task_id')->textInput() ?>

    <?= $form->field($model, 'approved1')->textInput() ?>

    <?= $form->field($model, 'approved1_date')->textInput() ?>

    <?= $form->field($model, 'approved1_time')->textInput() ?>

    <?= $form->field($model, 'approved2')->textInput() ?>

    <?= $form->field($model, 'approved2_date')->textInput() ?>

    <?= $form->field($model, 'approved2_time')->textInput() ?>

    <?= $form->field($model, 'approved3')->textInput() ?>

    <?= $form->field($model, 'approved3_date')->textInput() ?>

    <?= $form->field($model, 'approved3_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
