<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LineMember */

$this->title = 'Create Line Member';
$this->params['breadcrumbs'][] = ['label' => 'Line Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="line-member-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
