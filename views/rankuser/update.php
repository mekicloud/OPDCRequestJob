<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RankUser */

$this->title = 'Update Rank User: ' . $model->rank_id;
$this->params['breadcrumbs'][] = ['label' => 'Rank Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rank_id, 'url' => ['view', 'id' => $model->rank_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rank-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
