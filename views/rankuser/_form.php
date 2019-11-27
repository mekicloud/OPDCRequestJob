<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\MUser;
/* @var $this yii\web\View */
/* @var $model app\models\RankUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rank-user-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'rank_name')->textInput(['maxlength' => true]) ?>

    <label>ชื่อผู้ใช้งาน</label>
    <br>
    <?= Html::activeDropDownList($model, 'user_id',
      ArrayHelper::map(MUser::find()->all(), 'user_id', 'user_name'),['class' => 'form-control']) ?>
    <br>
    <?= $form->field($model, 'rank_priority')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
