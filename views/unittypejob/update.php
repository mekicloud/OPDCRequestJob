<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UnitTypejob */

$this->title = 'รหัส: ' . $model->typej_id;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทงาน', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->typej_id, 'url' => ['view', 'id' => $model->typej_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unit-typejob-update">

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
