<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskApproved */

$this->title = 'Create Task Approved';
$this->params['breadcrumbs'][] = ['label' => 'Task Approveds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-approved-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
