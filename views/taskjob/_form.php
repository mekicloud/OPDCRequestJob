<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UnitTypejob;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\field\FieldRange;
use kartik\time\TimePicker;
use dominus77\sweetalert2\Alert;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model app\models\TaskJob */
/* @var $form yii\widgets\ActiveForm */
?>

<script>

</script>


<div class="task-job-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row col-lg-12 col-md-12 col-xs-12" style="padding-left:30px;padding-right:30px">
        <?= Html::activeDropDownList(
            $model,
            'typej_id',
            ArrayHelper::map(UnitTypejob::find()->all(), 'typej_id', 'typej_detail'),
            ['class' => 'form-control']
        ) ?>
    </div>

    <div class="row col-lg-12 col-md-12 col-xs-12" style="padding-left:30px;padding-right:30px">
        <?= $form->field($model, 'task_detail')->textarea([
            'maxlength' => true,
            'placeholder' => 'รายละเอียด',

        ])->label('') ?>
    </div>


    <div class="row col-lg-12 col-md-12 col-xs-12">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?php echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'task_date_start',
                'name' => 'from_date',
                'type' => DatePicker::TYPE_RANGE,
                'value' => date('yyyy-mm-dd', strtotime('+543 years')),
                'options' => ['placeholder' => 'ตั้งแต่วันที่'],

                'attribute2' => 'task_date_end',
                'name2' => 'to_date',
                //'value2' =>  date('Y-m-d', strtotime('+543 years')),
                'options2' => ['placeholder' => 'ถึงวันที่'],
                'language' => 'th',

                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'startDate' =>  date('Y-m-d'),

                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row col-lg-12 col-md-12 col-xs-12">
        <div class="col-lg-6 col-md-6 col-xs-6" style="margin-top: 15px">
            <?php

            echo TimePicker::widget([
                'name' => 't1',
                'model' => $model,
                'attribute' => 'task_time_start',
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 5,
                    'secondStep' => 5,

                ]
            ]);
            ?>

        </div>
        <div class="col-lg-6 col-md-6 col-xs-6" style="margin-top: 15px;">
            <?php
            echo TimePicker::widget([
                'name' => 't1',
                'model' => $model,
                'attribute' => 'task_time_end',
                'pluginOptions' => [
                    'showSeconds' => false,
                    'showMeridian' => false,
                    'minuteStep' => 5,
                    'secondStep' => 5,
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row col-lg-12 col-md-12 col-xs-12">
        <div class="col-lg-8 col-md-12 col-xs-12">
            <?= $form->field($model, 'task_location')->textInput([
                'maxlength' => true,
                'placeholder' => 'สถานที่'
            ])->label('') ?>
        </div>
        <div class="col-lg-4 col-md-12 col-xs-12">
            <?= $form->field($model, 'task_personal')->textInput([
                'type' => 'number',
                'placeholder' => 'จำนวนคน',
                'min' => 0,
                'max' => 10
            ])->label('') ?>
        </div>
    </div>
    <div class="row col-lg-12 col-md-12 col-xs-12">
        <div class="form-group col-lg-12 col-md-12 col-xs-12">
            <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>