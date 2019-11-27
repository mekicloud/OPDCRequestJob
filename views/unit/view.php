<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\MUnit */

$this->title = $model->unit_id;
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มงาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="munit-view">

    <div class="panel panel-info">
        <div class="panel-heading">
            <?= Html::a('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> ย้อนกลับ', ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Update', ['update', 'id' => $model->unit_id], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete', ['delete', 'id' => $model->unit_id], [
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
            'unit_id',
            'unit_name',
            'rank_id',
            'dep_id',
            'unit_dep',
        ],
         ])*/
         /*test*/
         ?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'unit_name')->textInput(['maxlength' => true, 'disabled' => true]) ?>

<?= $form->field($model, 'rank_id')->textInput(['disabled' => true]) ?>

<?= $form->field($model, 'dep_id')->textInput(['maxlength' => true, 'disabled' => true]) ?>

<?= $form->field($model, 'unit_dep')->textInput([ 'disabled' => true]) ?>


<?php ActiveForm::end(); ?>

        </div>
    </div>

</div>