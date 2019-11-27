<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\MUnit;
/* @var $this yii\web\View */
/* @var $model app\models\UnitTypejob */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unit-typejob-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'typej_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'typej_detail')->textInput(['maxlength' => true]) ?>
    <label>ชื่อกลุ่มงานที่รับผิดชอบ</label>
    <br>
    <?= Html::activeDropDownList($model, 'unit_id',
      ArrayHelper::map(MUnit::find()->all(), 'unit_id', 'unit_name'),['class' => 'form-control']) ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
