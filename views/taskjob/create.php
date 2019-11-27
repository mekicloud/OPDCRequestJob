<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskJob */

$this->title = 'สร้างใบขอความอนุเคราะห์';

$this->params['breadcrumbs'][] = ['label' => 'Task Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-job-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
