<?php

use yii\helpers\Html;
//use yii\grid\GridView;
//use kartik\grid\GridView;
use fedemotta\datatables\DataTables;
use dominus77\sweetalert2\Alert;
use app\models\TaskApproved;
use app\models\TaskJob;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskJobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบคำร้อง';
$this->params['breadcrumbs'][] = $this->title;
$js=<<< JS
     $(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");
JS;

$this->registerJs($js, yii\web\View::POS_READY);
?>
<style>
input[type=checkbox] {
  cursor: pointer;
  height: 30px;
  margin:4px 0 0;
  position: absolute;
  opacity: 0;
  width: 30px;
  z-index: 2;
}

input[type=checkbox] + span {
  background: #e74c3c;
  border-radius: 50%;
  box-shadow: 0 2px 3px 0 rgba(0,0,0,.1);
  display: inline-block;
  height: 30px;
  margin:4px 0 0;
  position:relative;
  width: 30px;
  transition: all .2s ease;
}

input[type=checkbox] + span::before, input[type=checkbox] + span::after{
  background:#fff;
  content:'';
  display:block;
  position:absolute;
  width:4px;
  transition: all .2s ease;
}

input[type=checkbox] + span::before{
  height:16px;
  left:13px;
  top:7px;
  -webkit-transform:rotate(-45deg);
  transform:rotate(-45deg);
}

input[type=checkbox] + span::after{
  height:16px;
  right:13px;
  top:7px;
  -webkit-transform:rotate(45deg);
  transform:rotate(45deg);
}

input[type=checkbox]:checked + span {
  background:#2ecc71;			    
}

input[type=checkbox]:checked + span::before{
  height: 9px;
  left: 9px;
  top: 13px;
  -webkit-transform:rotate(-47deg);
  transform:rotate(-47deg);
}

input[type=checkbox]:checked + span::after{
  height: 15px;
  right: 11px;
  top: 8px;
}

input[type=submit] {
  background-color: #2ecc71;
  border: 0;
  border-radius: 4px;
  color: #FFF;
  cursor: pointer;
  display: inline-block;
  font-size:16px;
  text-align: center;
  padding: 12px 20px 14px;
}

#divAssign{


  left: 30%;

}
</style>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<script type="text/javascript">

        function confirmDisable($task_id) {
            swal.fire({
                title: "ต้องการยกเลิกใบคำร้องที่ " + $task_id + "<br>ใช่หรือไม่",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ปิด",
                closeOnConfirm: false,
                showCloseButton: true,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                    url: "../taskjob/disable/" + $task_id,
                    type: "GET",
                     data: {
                         id: 111
                     },
                    dataType: "html",
                     })
                }        
            })
        }

        function confirmApproved($task_id) {
            swal.fire({
                title: "ต้องการอนุมัติใบคำร้องที่ " + $task_id + "<br>ใช่หรือไม่",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#8FBC8F",
                confirmButtonText: "อนุมัติ",
                cancelButtonColor: "#DD6B55",
                cancelButtonText: "ไม่อนุมัติ",
                closeOnConfirm: false,
                showCloseButton: true,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                    url: "../taskjob/approved/" + $task_id,
                    type: "GET",
                     data: {
                         id: 111
                     },
                    dataType: "html",
                     });
                } 
                else if(result.dismiss === Swal.DismissReason.cancel){
                    $.ajax({
                    url: "../taskjob/notapproved/" + $task_id,
                    type: "GET",
                     data: {
                         id: 111
                     },
                    dataType: "html",
                     })
                }       
            })
        }

        var num_user_task ;
        var task_id ;
        function procAssign($task_id , $leader_type , $num_user) {
            num_user_task = $num_user;
            task_id = $task_id;
            document.getElementById("txtAss").innerHTML = "ใบคำร้องรายการที่ " + $task_id + " || จำนวนคนที่ต้องการ " + $num_user  ;
            document.getElementById("ddlAss")
            $("#divAssign").modal("show");
        }

        var chkAss = [];
        
        function saveAssignUser(theCheckbox) {
            var index = chkAss.indexOf(theCheckbox);   
               
            if (theCheckbox.checked) {
                if(chkAss.length < num_user_task){
                    if(index = -1){
                        chkAss.push(theCheckbox.value)
                    }
                }else{
                    document.getElementById(theCheckbox.value).checked = false;
                    Swal.fire('เกินจำนวนที่ระบุไว้ในใบคำร้อง');
                }
            }else{
                chkAss.splice(index,1);
            }
            //  alert(JSON.stringify(chkAss));
        }

        function saveNotApproved(){
           
                    $.ajax({
                    url: "../taskjob/notapproved/" + task_id,
                    type: "GET",

                    dataType: "html",
                     })
        }      
        

        function saveProcAssign(){
            // var jsonString = JSON.stringify(chkAss);
            swal.fire({
                title: "55555",
                text: "ยืนยันการมอบหมายงานใช่หรือไม่",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#27408B",
                confirmButtonText: "ยืนยัน",
                showCloseButton: true,
                cancelButtonText: "ปิด",
                closeOnConfirm: false,
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                    url: "../taskjob/assignsp",
                    type: "POST",
                    data:   { 
                            data_user : chkAss,
                            task_id : task_id
                            }, 
                    cache: false,
                   // dataType: "html",
                     })
                }
            })
           
        }
     
    
</script>
<?php $this->registerJs('
        function init_click_handlers(){
            $("#activity-create-link").click(function(e) {
                    $.get(
                        "create",
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("เพิ่มข้อมูลสมาชิก");
                            $("#activity-modal").modal("show");
                        }
                    );
                });
            $(".activity-view-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "view",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("เปิดดูข้อมูล");
                            $("#activity-modal").modal("show");
                        }
                    );
                });
            $(".activity-update-link").click(function(e) {
                    var fID = $(this).closest("tr").data("key");
                    $.get(
                        "update",
                        {
                            id: fID
                        },
                        function (data)
                        {
                            $("#activity-modal").find(".modal-body").html(data);
                            $(".modal-body").html(data);
                            $(".modal-title").html("แก้ไขข้อมูลสมาชิก");
                            $("#activity-modal").modal("show");
                        }
                    );
                });
            
        }
        init_click_handlers(); //first run
        $("#taskjob_pjax_id").on("pjax:success", function() {
          init_click_handlers(); //reactivate links in grid after pjax update
        });');?>

<?php Modal::begin([
        'id' => 'activity-modal',
        'header' => '<h4 class="modal-title">สมาชิก</h4>',
        'size'=>'modal-lg',
        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
        ]);
        Modal::end();
        ?>

<div class="row">
    <div id="divAssign" class="modal fade" style="width:40%">
    <div class="modal-body">
    <div class="form-group"  id="divUser">
                                    <div class="col-xs-12 col-md-12 col-lg-12  well">

                                            <?php       
                                                foreach ($user_data as $user_rs) {
                                                    ?>
                                                    <div style="vertical-align: text-top;">
                                                        <input type="checkbox" id='<?=$user_rs['user_id']?>' value='<?=$user_rs['user_id']?>' 
                                                            onclick = 'saveAssignUser(this)'>
                                                        <span></span>
                                                        <label><?=$user_rs['user_name']?></label>
                                                    </div>                                               
                                                <?php } ?>
                                    </div>
                                </div>

        <div id="txtAss" ></div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-danger" onclick="saveNotApproved()">ไม่อนุมัติ</button>
        <button type="button" data-dismiss="modal" class="btn btn-primary" onclick="saveProcAssign()">ยืนยัน</button>
        <button type="button" data-dismiss="modal" class="btn">ปิด</button>
    </div>
    </div>
</div>

<div class="task-job-index">
    <div>
        <p>
            <!-- Search form -->
            <form class="form-inline active-cyan-4">
            <?= Html::button('<i class="fas fa-plus-circle" aria-hidden="true"></i> สร้างใบคำร้อง', ['value' => Url::to(['taskjob/create']), 'title' => 'สร้างใบคำร้อง', 'class' => 'btn btn-success','id'=>'activity-create-link']); ?>
                
                <?= Html::a('<i class="fas fa-stream" aria-hidden="true"></i> Show Timeline', ['timeline'], ['class' => 'btn btn-primary']) ?>

            </form>
        </p>
    </div>



    <div class="panel panel-info">
        <div class="panel-heading"><i class="fas fa-file" aria-hidden="true"></i> ใบคำร้อง</div>
        <div class="panel-body">
        <?php Pjax::begin(['id'=>'taskjob_pjax_id']); ?>
            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'clientOptions' => [
                    "responsive" => true,
                    "order" => [[0,'desc']]
                ],
                'columns' => [
                   // ['class' => 'yii\grid\SerialColumn'],
                    'task_id',
                    'task_detail',
                    [
                        'attribute' => 'typej_id',
                        'value' => 'typej.typej_detail',
                    ],
                    'task_date_start',
                    'task_time_start:time',
                    'task_location',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Action',
                        
                        'buttonOptions' => ['class' => 'btn btn-default'],
                        'template' => '<div class="btn-group btn-group-sm text-center" role="group">{approved} {assign} {view} {update} {disable} </div>',
                        'options' => ['style' => 'width:200px;'],          
                        'buttons' => [   
                           
                                'approved' => function ( $model, $key) {
                                     if (TaskJob::get_leader_type() == 1){
                                        $id = $key['task_id'];
                                        return Html::button('<i class="fa fa-check" data-toggle="tooltip" title="อนุมัติ '
                                        .TaskJob::get_leader_type().'" ></i>',  ['class' => 'btn btn-success',
                                         'onclick' => "confirmApproved( $id )"]);
                                      }  
                                return "";
                            },
                                        
                        
                            'assign' => function ( $model, $key) {
                                if (TaskJob::get_leader_type() === 2){
                                    $id = $key['task_id'];
                                    $leader_type =  TaskJob::get_leader_type();
                                    $num_user = $key['task_personal'];
                                    return Html::button('<i class="fa fa-user-check" data-toggle="tooltip" title="จ่ายงาน"></i>', 
                                     ['class' => 'btn btn-primary',
                                      'onclick' => "procAssign( $id , $leader_type , $num_user  )"]);
                                }
                            return "";
                            },
                            // 'view' => function ($url, $model) {
                            //     return Html::a('<i class="fa fa-eye" data-toggle="tooltip" title=ดูรายละเอียด"></i>', $url, ['class' => 'btn btn-default']);
                            // },
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-eye" data-toggle="tooltip" title=ดูรายละเอียด"></i>','#', [
                                    'class' => 'activity-view-link btn btn-default',
                                    'title' => 'เปิดดูข้อมูล',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#activity-modal',
                                    'data-id' => $key,
                                    'data-pjax' => '0',
    
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-edit" data-toggle="tooltip" title="แก้ไขรายละเอียด"></i>','#', [
                                    'class' => 'activity-update-link btn btn-warning',
                                    'title' => 'แก้ไขรายละเอียด',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#activity-modal',
                                    'data-id' => $key,
                                    'data-pjax' => '0',
    
                                ]);
                            },
                            // 'update' => function ($url , $model) {
                            //     return Html::a('<i class="fa fa-edit" data-toggle="tooltip" title="แก้ไขรายละเอียด"></i>', $url, ['class' => 'btn btn-warning']);
                            // },
                            //  'delete' => function ($url, $model) {
                            //      return Html::a('label', ['/taskjob/disable'], ['class'=>'btn btn-primary']);
                            //  }, 
                             'disable' => function ( $model,$key) {
                                $id = $key['task_id'];
                                return Html::button('<i class="fa fa-trash-alt" data-toggle="tooltip"               
                                title=ดูรายละเอียด"></i>'
                                , ['class' => 'btn btn-danger', 'onclick' => "confirmDisable( $id )"]);
                            },        
                        ]
                    ],
                ],
                
            ]); ?>
            <?php Pjax::end() ?>
        </div>
    </div>

</div>
