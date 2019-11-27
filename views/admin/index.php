<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskAdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการผู้ดูแลระบบ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-admin-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>


    <div class="panel panel-info">
        <div class="panel-heading">
            <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มผู้ดูแลระบบ', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <div class="panel-body">

            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'admin',
                    //'status',
                    //'admin_type',
                    'typeName',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>

</div>