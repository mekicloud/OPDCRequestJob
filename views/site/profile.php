<?php
$session = Yii::$app->session;
$session->open(); // open a session

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
$this->title = 'User Profile';

?>
<div class="panel panel-info">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="collapsed" role="button" style="text-decoration:none" data-toggle="collapse" data-placement="right" title="คลิกเพื่อดูข้อมูล" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        <i class="far fa-user-circle"></i> User Profile
      </a>
    </h4>
  </div>
  <div class="panel-body">
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <ul class="list-group">
          <li class="list-group-item">คุณ : <?= $session->get('username') ?></li>
          <li class="list-group-item">สถานะ : <?= (empty($userdata['access_token']) ? "<i class='text text-danger'>ยังไม่ลงทะเบียน</i>" : "ลงทะเบียนแล้ว"); ?></li>
        </ul>
        <div class="alert alert-success" role="alert"><a href="<?= Yii::getAlias('@web') . '/uploads/RegisterLine.pdf'; ?>" target="_blank"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> ขั้นตอนการลงทะเบียน</a></div>
        <div class="alert alert-warning" role="alert">หมายเหตุ : คุณสามารถลงทะเบียนซ้ำได้ กรณีลบการแจ้งเตือนออกหรือเปลี่ยนบัญชี Line <?= (empty($userdata['access_token']) ? Html::a('คลิกที่นี่', $result, ['class' => 'btn btn-default btn-xs disabled']) : Html::a('คลิกที่นี่', $result, ['class' => 'btn btn-warning btn-xs'])); ?></div>
        <?php echo (empty($userdata['access_token']) ? Html::a('ลงทะเบียน', $result, ['class' => 'btn btn-success']) : Html::a('ลงทะเบียน', $result, ['class' => 'btn btn-default disabled'])); ?>

      </div>
    </div>
  </div>
</div>