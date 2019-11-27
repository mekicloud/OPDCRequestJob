<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\MUnit;
/* @var $this yii\web\View */
/* @var $model app\models\UnitTypejob */

$this->title = $model->typej_id;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทงาน', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="unit-typejob-view">

    <div class="panel panel-info">
        <div class="panel-heading">
            <?= Html::a('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> ย้อนกลับ', ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Update', ['update', 'id' => $model->typej_id], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete', ['delete', 'id' => $model->typej_id], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => 'คุณต้องการลบรายการที่เลือกหรือไม่ ?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="panel-body">
            <?php /*echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'typej_id',
                    'typej_detail',
                    'unit_id',
                ],
            ])*/ ?>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'typej_detail')->textInput(['class' => 'form-control', 'disabled' => true,'maxlength' => true]) ?>
            <label>ชื่อกลุ่มงานที่รับผิดชอบ</label>
            <br>
            <?= Html::activeDropDownList(
                $model,
                'unit_id',
                ArrayHelper::map(MUnit::find()->all(), 'unit_id', 'unit_name'),
                ['class' => 'form-control', 'disabled' => true]
            ) ?>
            <br>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>