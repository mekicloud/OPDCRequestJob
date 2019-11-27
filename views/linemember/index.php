<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LineMemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Line Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="line-member-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Line Member', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'access_token',
            'expried_token',
            'member_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
