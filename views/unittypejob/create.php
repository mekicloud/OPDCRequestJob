<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UnitTypejob */

$this->title = 'เพิ่มประเภทงาน';
$this->params['breadcrumbs'][] = ['label' => 'ประเภทงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-typejob-create">

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


</div>