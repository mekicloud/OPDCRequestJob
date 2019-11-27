<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\MUser;
use app\models\TaskAdmin;

/* @var $this yii\web\View */
/* @var $model app\models\TaskAdmin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <label>เลือกชื่อผู้ใช้งาน</label>
    <br>
    <?= Html::activeDropDownList($model, 'user_id',
      ArrayHelper::map(MUser::find()->all(), 'user_id', 'user_name'),['class' => 'form-control']) ?>
    <br>

    <?= $form->field($model, 'admin_type')->radioList(TaskAdmin::itemsAlias('admintype')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    

</div>
