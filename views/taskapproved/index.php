<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskApprovedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Log การอนุมัติ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-approved-index">

    <p>
        <?php //Html::a('Create Task Approved', ['create'], ['class' => 'btn btn-success']) 
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">ติดตามสถานะ</h3>
        </div>
        <div class="panel-body">
            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'task_id',
                    //'approved1:boolean',
                    [ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข
                        'attribute' => 'approved1',
                        'format'=>'html',
                        'value'=>function($model, $key, $index, $column){
                          return $model->approved1==1 ? "<span style=\"color:green;\">อนุญาต</span>":"<span style=\"color:red;\">รออนุญาต</span>";
                        }
                      ],
                    //'approved1_date',
                    [ // แสดงข้อมูล string
                        'attribute' => 'approved1_date',
                        'format'=>'html',
                        'value'=>function($model, $key, $index, $column){
                          return $model->approved1_date == '' ? "":$model->approved1_date;
                        }
                      ],
                    //'approved1_time:time',
                  
                    [
                        'attribute' => 'approved1_time',
                        'format' => ['time', 'php:H:i:s'],
                        'value'=>function($model, $key, $index, $column){
                            return $model->approved1_time == '' ? "00:00:00":$model->approved1_time;
                          }
                    ],      
                    //'approved2:boolean',
                    [ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข
                        'attribute' => 'approved2',
                        'format'=>'html',
                        'value'=>function($model, $key, $index, $column){
                          return $model->approved2==1 ? "<span style=\"color:green;\">อนุมัติ</span>":"<span style=\"color:red;\">รออนุมัติ</span>";
                        }
                      ],
                    //'approved2_date',
                    [ // แสดงข้อมูล string
                        'attribute' => 'approved2_date',
                        'format'=>'html',
                        'value'=>function($model, $key, $index, $column){
                          return $model->approved2_date == '' ? "":$model->approved2_date;
                        }
                      ],
                    //'approved2_time',
                    [
                        'attribute' => 'approved2_time',
                        'format' => ['time', 'php:H:i:s'],
                        'value'=>function($model, $key, $index, $column){
                            return $model->approved2_time == '' ? "00:00:00":$model->approved2_time;
                          }
                    ], 
                    //'approved3:boolean',
                    [ // แสดงข้อมูลออกเป็นสีตามเงื่อนไข
                        'attribute' => 'approved3',
                        'format'=>'html',
                        'options'=> ['style'=>'width:120px;'],
                        'value'=>function($model, $key, $index, $column){
                          return $model->approved3==1 ? "<span style=\"color:green;\">มอบหมายงาน</span>":"<span style=\"color:red;\">รอมอบหมายงาน</span>";
                        }
                      ],
                    //'approved3_date',
                    [ // แสดงข้อมูล string
                        'attribute' => 'approved3_date',
                        'format'=>'html',
                        'value'=>function($model, $key, $index, $column){
                          return $model->approved3_date == '' ? "":$model->approved3_date;
                        }
                      ],
                    //'approved3_time',
                    [
                        'attribute' => 'approved3_time',
                        'format' => ['time', 'php:H:i:s'],
                        'value'=>function($model, $key, $index, $column){
                            return $model->approved3_time == '' ? "00:00:00":$model->approved3_time;
                          }
                    ], 

                    // ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>