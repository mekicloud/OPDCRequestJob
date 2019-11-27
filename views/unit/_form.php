<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MUnit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="munit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'unit_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rank_id')->textInput() ?>

    <?= $form->field($model, 'dep_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_dep')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
