<?php

use brussens\bootstrap\select\Widget as Select;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\TaskJob */
/* @var $form yii\widgets\ActiveForm */

// $script = <<< JS
//     $('select').selectpicker();
// JS;
// $this->registerJs($script);
 ?>





<style>
    .componentWrapper {
        border: solid cadetblue;
        border-radius: 40px;
        padding: 15px 10px 10px;
        width: 95%;
    }

    .componentWrapper .header {
        position: absolute;
        margin-top: -25px;
        margin-left: 10px;
        color: white;
        background: cadetblue;
        border-radius: 10px;
        padding: 2px 10px;
    }

    label {
        float: left
    }

    span {
        display: block;
        overflow: hidden;
        padding: 0 4px 0 6px
    }
</style>

<div class="task-job-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-12 col-md-12 col-xs-12 componentWrapper">

        <div class="header">รายละเอียดรายการของความอนุเคราะห์</div>
        <form style="border:1px solid black">
            <div class="col-lg-12 col-md-12 col-xs-12" style="margin-top:2%">
                <label>ชื่อ :</label>
                <span>
                    <input class="form-control" value='<?= $data_task['user_name']; ?>' readonly></span>
            </div>
            <br><br>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <label>เรื่อง :</label>
                <span>
                    <input class="form-control" value='<?= $data_task['typej_detail']; ?>' readonly></span>
            </div>
            <br><br>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <label>รายละเอียด :</label>
                <span>
                    <input class="form-control" value='<?= $data_task['task_detail']; ?>' readonly></span>
            </div>
            <br><br>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <label>วันที่ :</label>
                <span>
                    <input class="form-control" value='<?= $data_task['task_date_start']; ?>' readonly></span>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <input class="form-control" value='<?= $data_task['task_date_end']; ?>' readonly>
            </div>
            <br><br>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <label>เวลา :</label>
                <span>
                    <input class="form-control" value='<?= $data_task['task_time_start']; ?>' readonly></span>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <input class="form-control" value='<?= $data_task['task_time_end']; ?>' readonly>
            </div>
            <br><br>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <label>สถานที่ :</label>
                <span>
                    <input class="form-control" value='<?= $data_task['task_location']; ?>' readonly></span>
            </div>
            <br><br>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <label>จำนวนคน :</label>
                <span><input class="form-control" value='<?= $data_task['task_personal']; ?>' readonly></span>
            </div>
    </div>



    <div>

        <select id="slgroup" class="selectpicker form-control" data-live-search="true">
            <?php
            $arrLength = count($data_user);
            if (!empty($data_user)) {
                for ($i = 0; $i < $arrLength; $i++) { ?>
                    <option value='<?= $data_user[$i]['user_id']; ?>'><?= $data_user[$i]['user_name']; ?></option>
            <?php }
            } ?>

        </select>

    </div>

    <div>
        <?php
        echo Select2::widget([
            'name' => 'state_10',
            'data' => $data_user['user_id'],
            'options' => [
                'placeholder' => 'Select provinces ...',
                'multiple' => true
            ],
        ]);
        ?>
    </div>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>