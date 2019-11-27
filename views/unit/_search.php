<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MUnitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="munit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'unit_id') ?>

    <?= $form->field($model, 'unit_name') ?>

    <?= $form->field($model, 'rank_id') ?>

    <?= $form->field($model, 'dep_id') ?>

    <?= $form->field($model, 'unit_dep') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
