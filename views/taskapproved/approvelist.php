<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UnitTypejobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ประเภทงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-typejob-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มประเภทงาน', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <div class="panel-body">
            <?= DataTables::widget([
                'id' => 'type-job',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'summary'=>'จำนวน <b>{begin}</b>-<b>{end}</b> ทั้งหมด <b>{totalCount}</b> รายการ',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'typej_id',
                    'typej_detail',
                    [
                        'attribute' => 'unit_id',
                        'value' => 'unit.unit_name',
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>
</div>