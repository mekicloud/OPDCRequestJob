<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'กลุ่มงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="munit-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <div class="panel panel-info">
        <div class="panel-heading">
            <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มกลุ่มงาน', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
        <div class="panel-body">
            <?= DataTables::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'summary'=>'จำนวน <b>{begin}</b>-<b>{end}</b> ทั้งหมด <b>{totalCount}</b> รายการ',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'unit_id',
                    'unit_name',
                    //'rank_id',

                    'dep_id',
                    'unit_dep',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>

</div>