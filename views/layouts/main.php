<?php

/* @var $this \yii\web\View */
/* @var $content string */
Yii::setAlias('@smart', 'https://smart.opdc.go.th');
//echo Url::to('@smart');
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\FunctionConfig;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'OPDC OSG Request Jobs',//Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $session = Yii::$app->session;
    $session->open(); // open a session
       
    if(!empty($session->get('UID'))){
        $id = $session->get('UID');
        
        //$getFunction = new FunctionConfig();
        //$getId = $getFunction->Decryption($session->get('UID'));
        
        $data = Yii::$app->db->createCommand("SELECT admin_type FROM m_task_admin WHERE user_id ='$id'")->queryScalar();
        //echo "adtype: ".$data;

        if(!empty($data) && $data <= 2){
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [

                    ['label' => 'ปฏิทินงาน', 'url' => ['/site/index']],
                    ['label' => 'จัดการใบคำร้อง', 'url' => ['/taskjob/index']],
                    ['label' => 'ประเภทคำร้อง', 'url' => ['/unittypejob/index']],
                    ['label' => 'จัดการกลุ่มงาน', 'url' => ['/unit/index']],
                    ['label' => 'จัดการผู้ดูแลระบบ', 'url' => ['/admin/index']],
                    ['label' => 'รายการอนุมัติ', 'url' => ['/taskapproved/index']],
                    //['label' => 'ผู้ใช้งาน '.$session->get('username'), 'url' => ['#']],
                    ['label' => 'ผู้ใช้งาน '.$session->get('username'),
                        'url' => ['#'],
                        'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
                        'items' => [
                            // ['label' => 'ข้อมูลบุคคล', 'url' => ['/site/profile']],
                            ['label' => 'กลับหน้าหลัก', 'url' => ['/site/signout']],
                        ],
                    ],
                    
                    Yii::$app->user->isGuest ? (
                        ''
                      //  ['label' => 'Login', 'url' => ['/site/login']]
                    ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                    )
                    
                ],
            ]);
            NavBar::end();
        }else{
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    
                    ['label' => 'ปฏิทินงาน', 'url' => ['/site/index']],
                    ['label' => 'จัดการใบคำร้อง', 'url' => ['/taskjob/index']],
                    //['label' => 'รายการอนุมัติ', 'url' => ['/taskapproved/index']],
                    ['label' => 'ผู้ใช้งาน '.$session->get('username'),
                        'url' => ['#'],
                        'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
                        'items' => [
                            // ['label' => 'ข้อมูลบุคคล', 'url' => ['/site/profile']],
                            ['label' => 'กลับหน้าหลัก', 'url' => ['/site/signout']],
                        ],
                    ],
                    Yii::$app->user->isGuest ? (
                        ''
                      //  ['label' => 'Login', 'url' => ['/site/login']]
                    ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                    )
                    
                ],
            ]);
            NavBar::end();
        }
        
    }else{
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                
                ['label' => 'หน้าหลัก', 'url' => ['/site/index']],
                               
            ],
        ]);
        NavBar::end();
    }
    
    
    ?>



    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; OPDC <?= date('Y') ?></p>

        <p class="pull-right"><?php //echo Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
