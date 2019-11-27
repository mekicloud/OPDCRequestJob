<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RankUser */

$this->title = 'เพิ่มระดับผู้ใช้งาน';
$this->params['breadcrumbs'][] = ['label' => 'ระดับผู้ใช้งาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rank-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
