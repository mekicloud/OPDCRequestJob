<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\MUser;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RankUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ผู้มีสิทธิ์อนุมัติ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rank-user-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('จัดการสิทธิผู้อนุมัติ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'rank_id',
            'rank_name',
            'rank_priority',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
