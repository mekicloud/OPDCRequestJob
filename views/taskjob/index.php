<?php

use yii\helpers\Html;
//use yii\grid\GridView;
//use kartik\grid\GridView;
use fedemotta\datatables\DataTables;
use dominus77\sweetalert2\Alert;
use app\models\TaskApproved;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskJobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบคำร้อง';
$this->params['breadcrumbs'][] = $this->title;
// if(empty($task_id)){

//     echo '<script language="javascript">';
//     echo 'alert("message successfully sent")';
//     echo '</script>';
// }else{

//     echo '<script language="javascript">';
//     echo 'alert(' . $task_id . ')';
//     echo '</script>';
// }

?>


<script type="text/javascript">
    <?php if (empty($key)) { ?>

        function notify($key) {
            alert('test');
            <?php Yii::$app->session->setFlash('', [
                    'options' => [
                        'title' => 'อนุญาติรายการ?',
                        'type' => Alert::TYPE_WARNING,
                        'showCancelButton' => true,
                        'confirmButtonColor' => '#3085d6',
                        'cancelButtonColor' => '#d33',
                        'confirmButtonText' => 'ตกลง',
                        'cancelButtonText' => 'ยกเลิก',
                    ],
                    'callback' => new \yii\web\JsExpression("
        function (result) {
            if(result.value === true){
                swal('บันทึกเรียบร้อย','','success')
                // alert('test');
                // $.ajax({
                //     url: '" . Yii::$app->urlManager->baseUrl . "/approved',
                //     data: { key  }
                // })
            }
        }
    "),
                ]) ?>
        };
    <?php } ?>
</script>


<div class="task-job-index">
    <div>
        <p>
            <!-- Search form -->
            <form class="form-inline active-cyan-4">
                <?= Html::a('<i class="fas fa-plus-circle" aria-hidden="true"></i> เพิ่มใบคำร้อง', ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('<i class="fas fa-stream" aria-hidden="true"></i> Show Timeline', ['timeline'], ['class' => 'btn btn-primary']) ?>

            </form>
        </p>
    </div>


    <?php 

    ?>


    <div class="panel panel-info">
        <div class="panel-heading"><i class="fas fa-file" aria-hidden="true"></i> ใบคำร้อง</div>
        <div class="panel-body">
            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'task_id',
                    'task_detail',
                    //'typej_id',
                    [
                        'attribute' => 'typej_id',
                        'value' => 'typej.typej_detail',
                    ],
                    'task_date_start',
                    'task_time_start',
                    //'task_date_end',
                    //'task_time_end',
                    //'task_owner',
                    //'task_order_date',
                    //'task_order_time',
                    'task_location',
                    //'task_personal',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Action',
                        'buttonOptions' => ['class' => 'btn btn-default'],
                        'template' => '<div class="btn-group btn-group-sm text-center" role="group">{approved} {capt} {view} {update} {delete} </div>',
                        'options' => ['style' => 'width:200px;'],
                        
                        'buttons' => [
                            'capt' => function ($url = 'capt', $model, $key) {
                                return Html::a('<i class="fa fa-user-check"></i>', $url, ['class' => 'btn btn-default']);
                            },
                            'approved' => function ($url = 'apporved', $model, $key) {
                                return Html::a('<i class="fa fa-check" onclick="notify(' . $key . ');"></i>', $url, ['class' => 'btn btn-success']);
                            },
                         
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>
