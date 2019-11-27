<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskAssign */

$this->title = 'Create Task Assign';
$this->params['breadcrumbs'][] = ['label' => 'Task Assigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-assign-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
