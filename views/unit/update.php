<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MUnit */

$this->title = 'แก้ไข: ' . $model->unit_id;
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->unit_id, 'url' => ['view', 'id' => $model->unit_id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="munit-update">
    
    
    <div class="panel panel-info">
        <div class="panel-heading">
            <?= Html::a('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> ย้อนกลับ', ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
        </div>
        <div class="panel-body">
        <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
    

</div>
