<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaskAdmin */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Task Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-admin-view">

<div class="panel panel-info">
        <div class="panel-heading">
            <?= Html::a('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> ย้อนกลับ', ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => 'คุณต้องการลบรายการที่เลือกหรือไม่ ?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        <div class="panel-body">


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'id')->textInput(['disabled' => true]) ?>

<?= $form->field($model, 'user_id')->textInput(['disabled' => true]) ?>

<?= $form->field($model, 'status')->textInput(['disabled' => true]) ?>

<?= $form->field($model, 'admin_type')->textInput(['disabled' => true]) ?>


<?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
